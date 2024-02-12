<?php
namespace App\Services;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Вычсление цен и скидок
     * @return array
     */
    public function calcDiscount()
    {
        $user = Auth::user();
        $bonus = $user->first()->bonus;
        $products = $user->products;
        if(!count($products)) {
            return  [
                'products' => $products,
                'beforePrice' => 0,
                'totalDiscount' => 0,
                'avg' => 0,
                'afterPrice' => 0];
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
            'products' => $products,
            'beforePrice' => $beforePrice,
            'totalDiscount' => $totalDiscount,
            'avg' => $avgForDiscount,
            'afterPrice' => $afterPrice
        ];
    }
    /**
     * Удаления товара из корзины
     * @return void
     */
    public function delete($request)
    {
        $user = Auth::user();
        $product_id = $request->id;
        $user->products()->detach($product_id);
    }

    /**
     * Добавляет  новый товар в корзину
     * @param $products array
     * @return void
     */
    public function add($request, User $user)
    {
        $product_id = $request->id;
        $user->products()->attach($product_id, ['count' => 1]);
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
}
