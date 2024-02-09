@extends('layouts.app')

@section('content')

    <main>
        <div class="container">
            <div class="form-wrap d-flex align-items-center justify-content-center">
                <form class="form p-5 shadow-lg rounded" action="{{ route('login') }}" method="POST">
                    @csrf
                    <a class="text-decoration-none fs-4 d-block text-center mb-3 text-dark" href="{{route('index')}}">НА
                        ГЛАВНУЮ</a>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Логин</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('email') }}">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1">
                        @error('password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </main>

@endsection
