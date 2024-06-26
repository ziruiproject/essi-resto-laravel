<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\MenuItem;
use Livewire\Component;

class ShowMenu extends Component
{
    public $food;
    public $categories;
    public $count;
    public $price;

    public function mount($id)
    {
        $this->food = MenuItem::find($id);
        $this->categories = $this->food->categories()->get();
        $this->count = 1;
        $this->price = $this->food->price;
    }

    public function add()
    {
        $this->count++;
        $this->price = $this->price + $this->food->price;
    }
    public function min()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->price = $this->price - $this->food->price;
        }
    }

    public function render()
    {
        return view('livewire.show-menu');
    }
}
