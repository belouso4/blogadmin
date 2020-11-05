@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Настройки сайта @endslot
            @slot('parent')  Главная @endslot
            @slot('active') Настройки сайта @endslot
        @endcomponent
    </section>

    <section class="content">
        <form action="{{ route('blog.admin.settings.update', $setting->id ?? '') }}" method="post" id="quickForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Название сайта</label>
                                <input id="title" name="title" class="form-control"
                                       required value="{{ $setting->title ?? '' }}" placeholder="Название сайта" type="text">
                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Описание"
                                         type="text">{{ $setting->description ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Create new Porject" class="btn btn-success float-right">
                </div>
            </div>
            <input type="hidden" id="file_name">
        </form>
    </section>

@endsection
