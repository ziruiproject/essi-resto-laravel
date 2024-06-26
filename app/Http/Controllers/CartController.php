<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['amount']++;
        } else {
            $cart[$request->id] = [
                'amount' => $request->amount
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back();
    }
}
