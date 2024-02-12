<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Products;
use App\Models\User;
use App\Services\CartService;
use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartsController extends Controller
{
    private CartService $cartService;
    private ProductsService $productsService;
    public function __construct(CartService $cartService, ProductsService $productsService)
    {
        $this->cartService = $cartService;
        $this->productsService = $productsService;
        $this->middleware('auth');
    }

    /**
     * Базовая страница корзины
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(CartService $cartService)
    {
        return view('cart', $cartService->calcDiscount());
    }
    /**
     * Добавляет новый товар в корзину возвращает
     * @return JsonResponse
     */
    public function add(AddRequest $request)
    {
        $user = Auth::user();
        $this->cartService->add($request, $user);
        return $this->productsService->currentProductCard($request->id, $user);
    }
    /**
     *  Обновляет данные в корзине
     *  @return JsonResponse
     */
    public function update(UpdateRequest $request)
    {
        $user = Auth::user();
        $res = $this->productsService->updateCard($request, $user);
        return response()->json(['success' => $res]);
    }
    /**
     *  Удаляет данные из корзины
     *  @return JsonResponse
     */
    public function delete(DeleteRequest $request )
    {
        $user = Auth::user();
        $this->cartService->delete($request);
        return $this->productsService->currentProductCard($request->id, $user);
    }
}
