@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Редактирование поста @endslot
            @slot('parent')  Главная @endslot
            @slot('post')  Список постов @endslot
            @slot('active')  Редактирование поста "{{$post->title}}" @endslot
        @endcomponent
    </section>

    <section class="content">
        <form action="{{ route('blog.admin.posts.update', $post->id) }}" method="post" id="quickForm">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Наименование товара</label>
                                <input id="title" name="title" class="form-control"
                                       required value="{{ $post->title }}" placeholder="Наименование товара" type="text">
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Категория</label>
                                <select id="parent_id" name="category_id" class="form-control custom-select">
                                    <option>
                                        -- выберите категорию --
                                    </option>
                                    @include('blog.admin.post.include.edit_categories_all_list', ['categories'=> $categories])
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">Контент</label>
                                <textarea name="content" id="editor-body" class="form-control textarea" required>{!! $post->content ?? '' !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Небольшое описание</label>
                                <textarea class="form-control" rows="3" placeholder="Отрывок ..." style="margin-top: 0px; margin-bottom: 0px; height: 71px;">{{ $post->excerpt ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input {{ $post->status ? 'checked' : null }} name="status" type="checkbox" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Статус</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input {{ $post->recommend ? 'checked' : null }} name="recommend" type="checkbox" class="custom-control-input" id="customSwitch2">
                                    <label class="custom-control-label" for="customSwitch2">Рекомендованная информация</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- <label for="customFile">Custom File</label> -->
                                        <div class="custom-file">
                                            <input onchange="upload(this)" type="file" class="custom-file-input" id="file">
                                            <label class="custom-file-label" for="customFile">Добавть картинку</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="keywords">Ключевые слова</label>
                                        <input id="keywords" name="keywords" class="form-control" placeholder="Ключевые слова"
                                               value="{{  $post->keywords ?? '' }}" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Описание</label>
                                        <input id="description" name="description" class="form-control" placeholder="Описание"
                                               value="{{  $post->description ?? '' }}" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="loading" class="overlay" style="display: none; flex-direction: column;position: absolute;top: 105px;left: 50%;transform: translateX(50%);">
                                        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                        <div class="text-bold pt-2">Loading...</div>
                                    </div>
                                    <ul id="singleimg" class="align-items-stretch clearfix" @if (!$post->img) style="display: none" @endif>
                                        <li style="display: block;border: 23px solid #f8f9fa;border-bottom: none;
    border-radius: 0.25rem;">
                                            <span class="has-img">
                                                @if ($post->img == null)

                                                @else
                                                    <img id="preview_image" style="max-width: 100%" src="{{ Storage::url($post->img) }}">
                                                @endif

                                            </span>
                                            <div class="mailbox-attachment-info">
                                                <a id="nameinsrt" href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                        <span id="sizemb">2.67 MB</span>
{{--                                        <span class="float-right">--}}
{{--                                             <i class="fas fa-cloud-download-alt"></i> &nbsp;&nbsp;--}}
{{--                                            <a href="javascript:removeFileImg()">--}}
{{--                                                <i style="color: red" class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                           </span>--}}

                                         </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a onclick="goBack()" href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create new Porject" class="btn btn-success float-right">
                </div>
            </div>
            <input type="hidden" id="file_name" value="{{ $post->img }}">
        </form>
    </section>

@endsection
