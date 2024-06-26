<?php

namespace App\Livewire;

use App\Models\MenuItem;
use App\Models\Transaction;
use Livewire\Component;

class Checkout extends Component
{
    public $carts;
    public $orderId;
    public $table;
    public $amount;
    public $total;
    public $snapToken;

    public function mount($id)
    {
        // Retrieve transactions based on order_id
        $transactions = Transaction::where('order_id', $id)->get(['menu_item_id', 'amount', 'price']);
        $this->snapToken = Transaction::where('order_id', $id)->first()->snap_token;

        // Retrieve the table_id, count of transactions, and total price
        $firstTransaction = Transaction::where('order_id', $id)->first();
        $this->table = $firstTransaction ? $firstTransaction->table_id : null; // Set table_id or null if no transaction
        $this->amount = $transactions->count();
        $this->total = $transactions->sum('price');

        // Set orderId
        $this->orderId = $id;

        // Retrieve menu items based on menu_item_ids
        $this->carts = MenuItem::whereIn('id', $transactions->pluck('menu_item_id'))->get();

        // Attach amount to corresponding menu items
        $this->carts->each(function ($menu_item) use ($transactions) {
            $transaction = $transactions->where('menu_item_id', $menu_item->id)->first();

            if ($transaction) {
                $menu_item->amount = $transaction->amount;
            } else {
                // Handle case where no corresponding transaction is found (if needed)
                $menu_item->amount = 0; // Or any default value
            }
        });
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
