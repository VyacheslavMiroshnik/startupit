<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartsController extends Controller
{
    /**
     * Вычсление цен и скидок
     * @return array
     */
    private function calcDiscount()
    {
        $user = Auth::user();
        $bonus = $user->bonus()->first()->bonus;
        $products = $user->products;
        if(!count($products)) {
            return  [
                'products'=>$products,
                'beforePrice'=>0,
                'totalDiscount'=>0,
                'avg'=>0,
                'afterPrice'=>0];
        }
        $beforePrice =self::sumPrice($products);
        $productDiscountPrice =self::sumPrice($products->where('discount', 1));
        if($bonus>$productDiscountPrice)
        {
            $avgForDiscount = 100;
        } else
        {
            $avgForDiscount = $bonus * 100 / $productDiscountPrice;
        }

        $totalDiscount = $productDiscountPrice * $avgForDiscount / $beforePrice;
        $afterPrice = $beforePrice * (100 - $totalDiscount) / 100;
        return [
            'products'=>$products,
            'beforePrice'=>$beforePrice,
            'totalDiscount'=>$totalDiscount,
            'avg'=>$avgForDiscount,
            'afterPrice'=>$afterPrice
        ];
    }
    /**
     * Подсчет стоимости  из  корзины пользователя
     * @param $products array
     */
    private function sumPrice($products)
    {
        $sum = 0;
        foreach($products as $product) {
            $sum +=  $product->price * $product->pivot->count;
        }
        return $sum;
    }
    /**
     * Базовая страница корзины
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('cart', self::calcDiscount());
    }
    /**
     * Добавляет новый товар в корзину возвращает
     * @return JsonResponse
     */
    public function add(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->id;
        $user->products()->attach($product_id, ['count' => 1]);
        return self::currentProductCard($product_id, $user);
    }
    /**
     *  возвращает  Html компонента для перерисовки
     *  @param $id int
     *  @param $user User
     */
    private function currentProductCard($id, User $user)
    {
        $carts = $user->products;
        $products = Products::findOrFail($id);
        $view = view('product', ['product'=>$products, 'carts'=>$carts])->render();
        return response()->json(['success' =>true, 'html'=>$view]);
    }
    /**
     *  Обновляет данные в корзине
     *  @return JsonResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $count = $request->count;
        $product_id = $request->id;
        $pivotRow = $user->products()->where('product_id', $product_id)->first()->pivot;
        $pivotRow->update(['count' => $count]);
        return response()->json(['success'=>true]);
    }
    /**
     *  Удаляет данные из корзины
     *  @return JsonResponse
     */
    public function delete(Request $request)
    {
        $user = Auth::user();
            $product_id = $request->id;
            $user->products()->detach($product_id);
            return self::currentProductCard($product_id, $user);
    }
}
