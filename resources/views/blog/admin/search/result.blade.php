@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Поиск по запросу: {{$query}} @endslot
            @slot('parent') Главная @endslot
            @slot('active') Поиск @endslot
        @endcomponent
    </section>


    <section class="content">
        <!-- Default box -->
        <div class="card">
            @if (!empty($posts))
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">

                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped projects text-nowrap">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                ID
                            </th>
                            <th style="width: 20%">
                                Название
                            </th>
                            <th style="width: 20%">
                                Изображение
                            </th>
                            <th style="width: 8%" class="text-center">
                                Статус
                            </th>
                            <th style="width: 20%;text-align: end">
                                Действия
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr @if ($post->status ==0 ) style="font-weight: bold" @endif>
                                <td>{{ $post->id }}</td>
                                <td>{{ Str::limit($post->title, 50) }}</td>
                                <td>
                                    @if (empty($post->img))
                                        <img style="width: auto;height: 50px" class="img-responsive zoom-img" src="{{ asset('/images/no_image.jpg') }}" alt="">
                                    @else
                                        <img style="width: auto;height: 50px" class="img-responsive zoom-img" src="{{ asset("/uploads/single/$post->img") }}" alt="">
                                    @endif
                                </td>
                                <td style="text-align: center">{{ $post->status ? 'On' : 'Off' }}</td>
                                <td class="project-actions text-right">
                                    <a title="Редактировать пост" class="btn btn-info btn-sm" href="{{ route('blog.admin.posts.edit', $post->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>
                                    @if ($post->status == 0)
                                        <a title="Изменить статус на On" class="btn btn-secondary btn-sm" href="{{ route('blog.admin.posts.returnstatus', $post->id) }}">
                                            <i class="fas fa-edit">
                                            </i>
                                        </a>
                                    @else
                                        <a class="btn btn-primary btn-sm" title="Изменить статус на Off" href="{{ route('blog.admin.posts.deletestatus', $post->id) }}">
                                            <i class="fas fa-edit">
                                            </i>
                                        </a>
                                    @endif

                                    <a id="{{ $post->id }}" data-toggle="modal" data-target="#modal-danger" class="btn btn-danger btn-sm delete" style="color: white">
                                        <i class="fas fa-trash">
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix text-center">
{{--                    <p>{{ count($posts) }} постов из {{ $count }}</p>--}}
{{--                    @if ($posts->total() > $posts->count())--}}
{{--                        <ul class="pagination pagination-sm m-0 justify-content-center">--}}
{{--                            {{ $posts->links() }}--}}
{{--                        </ul>--}}
{{--                    @endif--}}
                </div>
            @else
                <p>По вашему запросу ничего не найдено</p>
            @endif
        </div>

    </section>


@endsection
