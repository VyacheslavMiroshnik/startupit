<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carts = $user->products;
        return view('cart',['products'=>$carts]);
    }

    /* Добавляет новый товар в корзину возвращает  */
    public function add(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->id;
        $user->products()->attach($product_id, ['count' => 1]);
        return self::currentProductCard($product_id,$user);
    }
    /*  возвращает  Html компонента для перерисовки*/
    private function currentProductCard($id,$user)
    {
        $carts = $user->products;
        $products = Products::findOrFail($id);
        $view = view('product',['product'=>$products,'carts'=>$carts])->render();
        return response()->json(['success' =>true,"html"=>$view]);
    }

    /* Обновляет данные в корзине*/
    public function update(Request $request)
    {
        $user = Auth::user();
        $count = $request->count;
        $product_id = $request->id;
        $pivotRow = $user->products()->where('product_id', $product_id)->first()->pivot;
        $pivotRow->update(['count' => $count]);
        return response()->json(['success'=>true]);
    }


    /* Удаляет данные из корзины*/
    public function delete(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->id;
        $user->products()->detach($product_id);
        return self::currentProductCard($product_id,$user);
    }
}
