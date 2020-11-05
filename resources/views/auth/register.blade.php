@extends('layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="content-box">
    <div class="headline d-flex justify-between align-center">
        <h1>
            Свежие статьи
        </h1>
        <div class="breadcrumb">
            <a href="">
                Главная
            </a>
            <span> / </span>
            <p>Новости</p>
        </div>
    </div>
    <div class="main-content-center main-content-box" id="register">
        <form name="register" method="POST" action="{{ route('register') }}" onsubmit="return checkForm(this)">
            @csrf
            <div>
                <label for="name">Имя и/или фамилия:</label>
                <input class="input-style" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="" data-type="name" data-minlen="" data-maxlen="100" data-tminlen="" data-tmaxlen="Имя слишком длинное!" data-tempty="Вы не ввели имя!" data-ttype="Некорректное имя!" data-fequal="" data-tequal="">
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input class="input-style" id="email" type="text" name="email" value="{{ old('email') }}" placeholder="" data-type="email" data-minlen="" data-maxlen="100" data-tminlen="" data-tmaxlen="E-mail слишком длинный!" data-tempty="Вы не ввели e-mail!" data-ttype="Некорректный e-mail!" data-fequal="" data-tequal="">
            </div>							<div>
                <label for="password">Пароль:</label>
                <input class="input-style" type="password" name="password" id="password" data-type="" data-minlen="6" data-maxlen="100" data-tminlen="Пароль слишком короткий!" data-tmaxlen="Пароль слишком длинный!" data-tempty="Вы не ввели пароль!" data-ttype="" data-fequal="password_confirmation" data-tequal="Пароли не совпадают!">
            </div>							<div>
                <label for="password_conf">Подтвердите пароль:</label>
                <input class="input-style" type="password" name="password_confirmation" id="password_conf">
            </div>

            <div class="center">
                <input class="btn" type="submit" name="register" value="Регистрация">
            </div>
        </form>
    </div>
</div>
@endsection



