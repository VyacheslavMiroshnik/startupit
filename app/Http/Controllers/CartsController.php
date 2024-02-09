<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    // Вычсление цен и скидок
    private function calcDiscount()

    {
        $user = Auth::user();
        $bonus = $user->bonus()->first()->bonus;
        $products = $user->products;
        if(!count($products))
        {
            return  [
                'products'=>$products,
                'beforePrice'=>0,
                'totalDiscount'=>0,
                'avg'=>0,
                'afterPrice'=>0];;
        }
        $beforePrice =self::sumPrice($products);
        $productDiscountPrice =self::sumPrice($products->where('discount',1));
        if($bonus>$productDiscountPrice)
        {
            $avgForDiscount = 100;
        } else
        {
            $avgForDiscount = $bonus * 100 /$productDiscountPrice;
        }

        $totalDiscount = $productDiscountPrice*$avgForDiscount /$beforePrice;
        $afterPrice = $beforePrice * (100-$totalDiscount) / 100;
        return [
            'products'=>$products,
            'beforePrice'=>$beforePrice,
            'totalDiscount'=>$totalDiscount,
            'avg'=>$avgForDiscount,
            'afterPrice'=>$afterPrice];
    }

///     Подсчет стоимости  из  корзины пользователя
    private function sumPrice($products)
    {
        $sum = 0;
        foreach($products as $product)
        {
            $sum +=  $product->price * $product->pivot->count ;
        }
        return $sum;

    }
//    Базовая страница корзины
    public function index()
    {
        return view('cart',self::calcDiscount());
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
