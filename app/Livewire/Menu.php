<?php

namespace App\Livewire;

use App\Models\MenuItem;
use Livewire\Component;

class Menu extends Component
{
    public $menu;
    public $search = '';

    public function mount()
    {
        $this->menu = MenuItem::all();
    }

    public function updatedSearch($value)
    {
        $this->menu = MenuItem::where('name', 'like', '%' . $value . '%')->get();
    }

    public function render()
    {
        return view('livewire.menu');
    }
}
