<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function updateTotal(Request $request)
    {
        $productAmount = (float)$request->input('productAmount');
        $shippingCharge = (float)$request->input('shippingCharge');
        $paybleAmount = $productAmount + $shippingCharge;
        return response()->json([
            'productAmount' => $productAmount,
            'shippingCharge' => $shippingCharge,
            'paybleAmount' => $paybleAmount,
        ]);
    }
}
