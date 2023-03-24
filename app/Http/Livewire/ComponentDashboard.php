<?php

namespace App\Http\Livewire;

use App\Models\Entity;
use App\Models\Planning;
use App\Models\User;
use Livewire\Component;

class ComponentDashboard extends Component
{
    public function render()
    {
        $entities = Entity::all();
        $users = User::all();
        $plannigs = Planning::all();
        return view('livewire.component-dashboard', compact('entities', 'users', 'plannigs'));
    }
}
