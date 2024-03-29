{{--
    Компонент  идентичен, карточке товара из главного меню. Использую для
    отправки на фронтенда для обновления карточки без перезагрузки страницы
--}}
            <article class="card mt-5 overflow-hidden border-primary  product__card" data-id="{{ $product->id }}">
                <div class="img-wrap">
                    <img class="w-100" src="{{ asset('storage/img') }}/{{ $product->img }}" alt="Изображение товара">
                </div>
                <div class="p-3">
                    <h3 class="fs-6 mb-3">
                        {{ $product->description }}
                    </h3>
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="fw-bold fs-5 m-0">
                            {{ $product->price }}  ₽
                        </p>
                        @guest
                            <a class="btn btn-primary btn-add__cart"  href="{{ route('login') }}">
                                В корзину
                            </a>
                        @endguest

                        @auth
                            @if(!$carts->contains($product->id))
                                <button class="btn btn-primary btn-add__cart" >
                                    В корзину
                                </button>
                            @else
                                <div class="d-flex align-items-center gap-3  cart__counter">
                                    <button class="btn btn-outline-primary btn-diff__product">-</button>
                                    <span class="count">{{ $carts->where('id', $product->id)->first()->pivot->count }}</span>
                                    <button class="btn btn-outline-primary btn-add__product">+</button>
                                </div>
                            @endif
                        @endauth

                    </div>
                </div>
            </article>

