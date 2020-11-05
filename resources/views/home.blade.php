@extends('layouts.app')

@section('content')
    sssssss
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
        <div class="news">

            @foreach($getAllPosts as $post)
                <div class="news__item">
                    <div class="news__content d-flex">
                        <div class="news__img">
                            <img src="{{ Storage::url('image/'.$post->img) }}" alt="">
                            <span>{{ $post->created_at ? $post->created_at->format('d.m.Y') : 'n/a'}}</span>
                        </div>
                        <div class="news__text">
                            <h3>
                                {{ $post->title }}
                            </h3>
                        {{ Str::limit(strip_tags($post->content), '550') }}

                            {{--                            {!! Str::of(Str::limit(Str::words($post->content), '400'))->trim(); !!}--}}
                        </div>
                    </div>
                    <div class="news__elem">

                        <a class="btn-green" href="{{ route('blog.post.show', [$post->category->alias, $post->alias]) }}">Подробнее</a>
                    </div>
                </div>

            @endforeach
                @if ($getAllPosts->total() > $getAllPosts->count())
                    <ul class="pagination pagination-sm m-0 justify-content-center">
                        {{ $getAllPosts->links() }}
                    </ul>
                @endif
        </div>
    </div>
@endsection
