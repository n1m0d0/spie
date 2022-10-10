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

class ComponentUser extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireToast;

    public $action;
    public $iteration;
    public $search;

    public $entity_id;
    public $state_id;
    public $name;
    public $lastname_paternal;
    public $lastname_maternal;
    public $identity_card;
    public $email;
    public $password;
    public $user_id;

    public $deleteModal;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $rules = [
        'entity_id' => 'required',
        'name' => 'required|max:200',
        'lastname_paternal' => 'max:200',
        'lastname_maternal' => 'max:200',
        'identity_card' => 'required|max:200',
        'email' => 'required|unique:users|max:100'
    ];

    public function mount()
    {
        $this->action = 'create';
        $this->iteration = rand(0, 999);
        $this->deleteModal = false;
    }

    public function render()
    {
        $Query = User::query();
        if ($this->search != null) {
            $this->updatingSearch();
            $Query = $Query->where('name', 'like', '%' . $this->search . '%');
        }
        $users = $Query->where('state_id', 1)->orderBy('id', 'DESC')->paginate(7);
        $entities = Entity::all();
        return view('livewire.component-user', compact('users', 'entities'));
    }

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->entity_id = $this->entity_id;
        $user->state_id = 1;
        $user->name = $this->name;
        $user->lastname_paternal = $this->lastname_paternal;
        $user->lastname_maternal = $this->lastname_maternal;
        $user->identity_card = $this->identity_card;
        $user->email = $this->email;
        $user->password = bcrypt("sistemas123");
        $user->save();

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
        $this->lastname_paternal = $user->lastname_paternal;
        $this->lastname_maternal = $user->lastname_maternal;
        $this->identity_card = $user->identity_card;
        $this->email = $user->email;

        $this->action = "edit";
    }

    public function update()
    {
        $user = User::find($this->user_id);

        $this->validate([
            'entity_id' => 'required',
            'name' => 'required|max:200',
            'lastname_paternal' => 'max:200',
            'lastname_maternal' => 'max:200',
            'identity_card' => 'required|max:200',
            'email' => ['required', 'max:100', Rule::unique('users')->ignore($this->user_id)]
        ]);

        $user->entity_id = $this->entity_id;
        $user->name = $this->name;
        $user->lastname_paternal = $this->lastname_paternal;
        $user->lastname_maternal = $this->lastname_maternal;
        $user->identity_card = $this->identity_card;
        $user->email = $this->email;
        $user->save();

        $this->action = "create";
        $this->clear();
        toast()
            ->success('Se actualizo correctamente')
            ->push();
    }

    public function clear()
    {
        $this->reset(['entity_id', 'state_id', 'name', 'lastname_paternal', 'lastname_maternal', 'identity_card', 'email', 'user_id']);
        $this->iteration++;
        $this->action = "create";
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
