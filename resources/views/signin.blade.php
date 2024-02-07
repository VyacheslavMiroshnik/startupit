@extends('layouts.app')
@section('title','enter')

@section('style')
    @vite('resources/css/signin.css')
@endsection

@section('content')
    <main>
        <div class="container">
            <div class="form-wrap d-flex align-items-center justify-content-center">
                <form class="form p-5 shadow-lg rounded">
                    <a class="text-decoration-none fs-4 d-block text-center mb-3 text-dark" href="/index.html">НА
                        ГЛАВНУЮ</a>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Логин</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div class="text-danger mt-2">
                            Пожалуйста, введите корректный логин.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                        <div class="text-danger mt-2">
                            Пожалуйста, введите пароль.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>

    </main>
@endsection

