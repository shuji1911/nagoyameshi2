@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-9">
                <h1 class="mb-3">新規会員登録</h1> 
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif                

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-5 col-form-label text-md-left fw-bold">氏名<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="侍太郎">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-5 col-form-label text-md-left fw-bold">メールアドレス<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="taro.samurai@example.com">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="postal_code" class="col-md-5 col-form-label text-md-left fw-bold">郵便番号<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required placeholder="1234567">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="address" class="col-md-5 col-form-label text-md-left fw-bold">住所<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required placeholder="東京都侍区侍町1-2-3">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="phone_number" class="col-md-5 col-form-label text-md-left fw-bold">電話番号<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required placeholder="09012345678">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password" class="col-md-5 col-form-label text-md-left fw-bold">パスワード<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="password-confirm" class="col-md-5 col-form-label text-md-left fw-bold">パスワード再入力<span class="ms-1 bg-danger p-1"><span class="text-white small">必須</span></span></label>

                        <div class="col-md-7">
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            アカウント作成
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection