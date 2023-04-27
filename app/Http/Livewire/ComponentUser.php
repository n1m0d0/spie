<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;
use Illuminate\Support\Facades\DB;

class ComponentUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $activity;
    public $iteration;
    public $search;

    public $entity_id;
    public $state_id;
    public $name;
    public $paternal;
    public $maternal;
    public $identity;
    public $email;
    public $password;
    public $role;
    public $user_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'entity_id' => 'required',
        'name' => 'required|max:200',
        'paternal' => 'max:200',
        'maternal' => 'max:200',
        'identity' => 'required|max:200',
        'email' => 'required|unique:users|max:100',
        'role' => 'required'
    ];

    public function mount()
    {
        $this->activity = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = User::query()
        ->when($this->search, function($query){
            $query->where('name', 'like', '%' . $this->search . '%');
        });
        $users = $Query->where('state_id', 1)->where('id', "!=", 1)->orderBy('id', 'DESC')->paginate(7);
        $entities = Entity::all();
        $roles = DB::table('roles')->where('guard_name', 'web')->get();
        return view('livewire.component-user', compact('users', 'entities', 'roles'));
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->entity_id = $this->entity_id;
        $user->state_id = 1;
        $user->name = $this->name;
        $user->paternal = $this->paternal;
        $user->maternal = $this->maternal;
        $user->identity = $this->identity;
        $user->email = $this->email;
        $user->password = bcrypt("sistemas123");
        $user->save();

        $user->assignRole($this->role);

        $this->clear();
        toast()
            ->success('Se guardo correctamente')
            ->push();
    }

    public function edit($id)
    {
        $this->user_id = $id;

        $user = User::find($id);

        $this->entity_id = $user->entity_id;
        $this->name = $user->name;
        $this->paternal = $user->paternal;
        $this->maternal = $user->maternal;
        $this->identity = $user->identity;
        $this->email = $user->email;
        $this->role = $user->getRoleNames()[0];

        $this->activity = "edit";
    }

    public function update()
    {
        $user = User::find($this->user_id);

        $this->validate([
            'entity_id' => 'required',
            'name' => 'required|max:200',
            'paternal' => 'max:200',
            'maternal' => 'max:200',
            'identity' => 'required|max:200',
            'email' => ['required', 'max:100', Rule::unique('users')->ignore($this->user_id)],
            'role' => 'required'
        ]);

        $user->removeRole($user->getRoleNames()[0]);

        $user->entity_id = $this->entity_id;
        $user->name = $this->name;
        $user->paternal = $this->paternal;
        $user->maternal = $this->maternal;
        $user->identity = $this->identity;
        $user->email = $this->email;
        $user->save();

        $user->assignRole($this->role);

        $this->activity = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function modalDelete($id)
    {
        $this->user_id = $id;

        $this->deleteModal = true;
    }

    public function delete()
    {
        $user = User::find($this->user_id);

        $user->state_id = 2;
        $user->save();

        $this->deleteModal = false;
        $this->clear();
        toast()
            ->success('Se elimino correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['entity_id', 'state_id', 'name', 'paternal', 'maternal', 'identity', 'email', 'user_id', 'role']);
        $this->iteration++;
        $this->activity = "create";
    }

    public function resetSearch()
    {
        $this->reset(['search']);
        $this->updatingSearch();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
