@extends('blog.admin.app_admin')

@section('content')

<section class="content-header">
    @component('blog.admin.components.breadcrumb')
        @slot('title') Создание нового поста @endslot
        @slot('parent')  Главная @endslot
        @slot('post')  Список постов @endslot
        @slot('active')  Создание нового поста @endslot
    @endcomponent
</section>

<section class="content">
    <form action="{{ route('blog.admin.posts.store', $item->id) }}" method="post" id="quickForm" enctype="multipart/form-data">
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
                                   required value="{{ old('title') }}" placeholder="Наименование товара" type="text">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Категория</label>
                            <select id="parent_id" name="category_id" class="form-control custom-select">
                                <option value="0">
                                    -- выберите категорию --
                                </option>
                                @include('blog.admin.post.include.edit_categories_all_list', ['categories'=> $categories])
                            </select>
                        </div>

                                                <div class="form-group">
                            <label for="inputDescription">Контент</label>
                            <textarea name="content" id="editor-body" class="form-control textarea" required>{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Небольшое описание</label>
                            <textarea name="excerpt" class="form-control" rows="3" placeholder="Отрывок ..." style="margin-top: 0px; margin-bottom: 0px; height: 71px;"></textarea>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>--}}
{{--                                <input type="checkbox" name="status" checked> Статус--}}
{{--                            </label>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input checked name="status" type="checkbox" class="custom-control-input" id="status">
                                <label class="custom-control-label" for="status">Статус</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input name="recommend" type="checkbox" class="custom-control-input" id="recommend">
                                <label class="custom-control-label" for="recommend">Рекомендованная информация</label>
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
                                           value="{{ old('keywords') }}" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input id="description" name="description" class="form-control" placeholder="Описание"
                                           value="{{ old('description') }}" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="loading" class="overlay" style="display: none; flex-direction: column;">
                                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                    <div class="text-bold pt-2">Loading...</div>
                                </div>

                                <ul id="singleimg" class="align-items-stretch clearfix" style="display: none">
                                    <li style="display: block;border: 23px solid #f8f9fa;border-bottom: none;
    border-radius: 0.25rem;">
                                        <span class="has-img"><img id="preview_image" style="width: 450px" src="../../dist/img/photo1.png" alt="Attachment"></span>
                                        <div class="mailbox-attachment-info">
                                            <a id="nameinsrt" href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                                            <span class="mailbox-attachment-size clearfix mt-1">
                                        <span id="sizemb">2.67 MB</span>
{{--                                        <span class="float-right">--}}
{{--                                             <i class="fas fa-cloud-download-alt"></i> &nbsp;&nbsp;--}}
{{--                                            <a href="javascript:removeFile()">--}}
{{--                                                <i style="color: red" class="fas fa-trash"></i>--}}
{{--                                            </a>--}}
{{--                                           </span>--}}

{{--                                         </span>--}}
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
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Porject" class="btn btn-success float-right">
            </div>
        </div>
        <input type="hidden" id="file_name">
    </form>
</section>

@endsection
