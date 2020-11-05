@extends('layouts.app')

@section('content')
        <div class="content-box">
            <div class="headline d-flex justify-between align-center">
                <h1>
                    {{ $item->title }}
                </h1>
                <div class="breadcrumb">
                    <a href="index.html">
                        Главная
                    </a>
                    <span> / </span>
                    <p>Новости</p>
                </div>
            </div>
            <div class="main-content-box">
                <h1 style="margin-bottom: 20px">
                    {{ $item->title }}
                </h1>
                <img style="max-width: 100%" src="{{ asset("uploads/single/$item->img") }}" alt="">
                <div>
                    {!! $item->content !!}
                </div>

                <div class="article_info">
                    <img src="{{ asset('asset/img/clock.svg') }}" alt="" style="width: 10px;">
                    Создано {{ $item->created_at ? $item->created_at->format('d.m.Y') : 'n/a'}}
                </div>
            </div>
{{--            <div class="pagination pagination1">--}}
{{--                <span>Предыдущая</span>--}}
{{--                <a href="" title="Следующая">Следующая</a>--}}
{{--            </div>--}}
        </div>

    </section>

@endsection
