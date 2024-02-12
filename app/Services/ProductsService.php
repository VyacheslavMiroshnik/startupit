<?php

namespace App\Services;

use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductsService
{
    /**
     *  возвращает  Html компонента для перерисовки
     *  @param $id int
     *  @param $user User
     */
    public function currentProductCard($id, User $user)
    {
        $carts = $user->products;
        $products = Products::findOrFail($id);
        $view = view('product', ['product'=>$products, 'carts'=>$carts])->render();
        return response()->json(['success' =>true, 'html'=>$view]);
    }
    /**
     *  Обновляет данные карточки
     *
     *  @return bool
     */
    public function updateCard($request , User $user)
    {
        $count = $request->count;
        $product_id = $request->id;
        $pivotRow = $user->products()->where('product_id', $product_id)->first()->pivot;
        $pivotRow->update(['count' => $count]);
        return true;
    }

    /**
     *  Возвращает карточки с продуктами,
     *  если пользователь авторизован,
     *  то возвращает eше его  корзину.
     *  @return array
     */
    public function index()
    {
        $user = Auth::user();
        $carts = [];
        if ($user) {
            $carts = $user->products;
        }
        $productsPaginated = Products::paginate(12);
        return ['products' => $productsPaginated, 'carts' => $carts];
    }
}
