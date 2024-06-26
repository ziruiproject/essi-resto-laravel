<?php

namespace App\Livewire;

use App\Models\MenuItem;
use App\Models\Table;
use Livewire\Component;

class Cart extends Component
{
    public $carts = [];
    public $total = 0;
    public $dine = '0';
    public $tables = [];
    public $table = '';

    public function mount()
    {
        $this->tables = Table::all();
        $this->tables->pop();
        $this->loadCart();
    }

    public function loadCart()
    {
        foreach (session('cart', []) as $id => $item) {
            $menuItem = MenuItem::find($id);
            if ($menuItem) {
                $menuItem->amount = $item['amount'];
                $this->carts[] = $menuItem;
                $this->total += $menuItem->price * $item['amount'];
            }
        }
    }

    public function min($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ($cart[$id]['amount'] > 1) {
                $cart[$id]['amount']--;
                session()->put('cart', $cart);
                $this->reset(['carts', 'total']);
                $this->loadCart();
            }
        }
    }

    public function add($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['amount']++;
            session()->put('cart', $cart);
            $this->reset(['carts', 'total']);
            $this->loadCart();
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
