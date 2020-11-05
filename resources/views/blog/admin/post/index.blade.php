@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Список постов @endslot
            @slot('parent')  Главная @endslot
            @slot('active')  Список постов @endslot
        @endcomponent
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="card-tools">

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
                        <th style="width: 30%;text-align: center">
                            Категория
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
                    @foreach ($getAllPosts as $post)
                        <tr @if ($post->status ==0 ) style="font-weight: bold" @endif>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td style="text-align: center">{{ $post->cat }}</td>
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

                                <a id="{{ $post->id }}" data-toggle="modal" data-target="#modal-danger"  class="btn btn-danger btn-sm delete" style="color: white">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </td>
{{--                            <td>--}}
{{--

{{--                                @if ($post)--}}
{{--                                    <a class="delete" title="Удалить из БД" href="{{ route('blog.admin.products.deleteproduct', $product->id) }}"><i class="fa fa-fw fa-close text-danger delete"></i></a>--}}
{{--                                                                                    {{ route('blog.admin.products.deleteproduct', $product->id) }}--}}
{{--                                @endif--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix text-center">
                <p>{{ count($getAllPosts) }} постов из {{ $count }}</p>
                @if ($getAllPosts->total() > $getAllPosts->count())
                <ul class="pagination pagination-sm m-0 justify-content-center">
                    {{ $getAllPosts->links() }}
                </ul>
                @endif
            </div>

        </div>

    </section>
{{--    <script>--}}
{{--        $(".typeahead").typeahead({--}}
{{--            source: ["Amsterdam", "Washington", "Sydney", "Beijing", "Cairo"]--}}
{{--        });--}}
{{--    </script>--}}

@endsection




