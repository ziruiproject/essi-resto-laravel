<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $foods = session()->get('cart');

        $orderId = rand();

        foreach ($foods as $id => $item) {
            $menuItem = MenuItem::find($id);

            Transaction::create([
                'table_id' => $request->table,
                'menu_item_id' => $id,
                'amount' => $item['amount'],
                'price' => $menuItem->price,
                'status' => 'pending',
                'order_id' => $orderId
            ]);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $request->total,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        Transaction::where('order_id', $orderId)->update([
            'snap_token' => $snapToken,
        ]);

        return redirect()->route('checkout', ['id' => $orderId]);
    }
}
