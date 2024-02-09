<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        $carts= [];
        if($user)
        {
            $carts = $user->products;
        }
        $productsPaginated = Products::paginate(12);
        return view('index',['products'=>$productsPaginated,'carts'=>$carts]);
    }

}
