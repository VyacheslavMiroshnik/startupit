@extends('layouts.app')
@section('title','cart')
@section('style')
    @vite('resources/css/cart.css')
@endsection
@section('content')
    <main>
        <div class="container">
            <h1 class="text-center mt-5">Корзина</h1>
            <div class="row mb-4">
            @if(!count($products))
                <div class="col-12 col-lg-8">
                    <h2>Корзина пуста</h2>
                </div>
            @endif
            @foreach($products as $product)
                <div class="col-12 col-lg-8">
                    <article class="card mt-4 overflow-hidden">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="img-wrap">
                                    <img class="w-100" src="{{asset('storage/img')}}/{{$product->img}}" alt="Изображение товара">
                                </div>
                            </div>
                            <div class="col-12 col-sm-8 d-flex align-items-center">
                                <div class="p-3">
                                    <h3 class="fs-6 mb-2">
                                       {{$product->description}}
                                    </h3>
                                    <p>
                                        {{$products->where('id',$product->id)->first()->pivot->count}}
                                    </p>
                                    <p class="fw-bold fs-6 m-0">
                                        цена без скидки - {{$products->sum('price')}} ₽ / шт.
                                    </p>
                                    <p class="fw-bold fs-6 m-0">
                                        с учётом скидки <span>5%</span> - 734 616 ₽ / шт.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
                <div class="col-12 col-lg-4">
                    <div class="card p-3 mt-4">
                        <p class="fs-4">Общая сумма заказа:</p>
                        <p class="fw-bold">773 280 ₽</p>
                        <p class="fs-4">Общая сумма заказа c учётом скидки <span>5%</span>:</p>
                        <p class="fw-bold">734 616 ₽</p>
                        <button class="btn btn-primary">Заказать</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
