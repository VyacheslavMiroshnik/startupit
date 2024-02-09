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
{{--      Если нет товаров выводить надпись корзина пуста          --}}
           @if(!count($products))
                <div class="col-12 col-lg-8">
                    <h2>Корзина пуста</h2>
                </div>
           @else
                <div class="col-12 col-lg-8">

{{--               отображения карточки товара в корзине     --}}
                    @foreach($products as $product)
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
                                        Кол-во -  {{$products->where('id',$product->id)->first()->pivot->count}} шт.
                                    </p>
                                    <p class="fw-bold fs-6 m-0">
                                        цена без скидки - {{$product->price}} ₽ / шт.
                                    </p>

{{--                                    не отображать если  у товара нет скидки                                    --}}
                                    @if($product->discount)
                                    <p class="fw-bold fs-6 m-0">
                                        с учётом скидки <span>{{round($avg,2)}}%</span> - {{round((($product->price)*(100-$avg)/100),2)}} ₽ / шт.
                                    </p>
                                     @endif
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
           @endif
                <div class="col-12 col-lg-4">
                    <div class="card p-3 mt-4">
                        <p class="fs-4">Общая сумма заказа:</p>
                        <p class="fw-bold">{{round($beforePrice,2)}} ₽</p>
                        <p class="fs-4">Общая сумма заказа c учётом скидки <span>{{round($totalDiscount,2)}}%</span>:</p>
                        <p class="fw-bold">{{round($afterPrice,2)}} ₽</p>
                        <button class="btn btn-primary">Заказать</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
