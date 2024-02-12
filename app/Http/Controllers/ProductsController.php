<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct(ProductsService $productsService)
    {
        $this->productService = $productsService;
    }
    /**
     * Стартовая страница
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('index', $this->productService->index());
    }
}
