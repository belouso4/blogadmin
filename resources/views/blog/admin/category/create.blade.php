@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Создание новой категории @endslot
            @slot('parent')  Главная @endslot
            @slot('category') Список категорий @endslot
            @slot('active') Создание новой категории @endslot
        @endcomponent
    </section>
    <section class="content">
        <form action="{{ route('blog.admin.categories.store') }}" id="quickForm" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Наименование категории</label>
                                    <input id="title" name="title" class="form-control"
                                           placeholder="Наименование категории"
                                           required value="{{ old('title', $item->title) }}" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">Выбрать родителя для категории</label>
                                    <select id="parent_id" name="parent_id" class="form-control custom-select" required>
                                        <option value="0">
                                            -- самостоятельная категория --
                                        </option>
                                        @include('blog.admin.category.include.edit_categories_all_list', ['categories'=> $categories])
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Ключевые слова</label>
                                    <input id="keywords" name="keywords" class="form-control"
                                           placeholder="Ключевые слова"
                                           required value="{{ old('keywords', $item->keywords) }}" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="description">Описание</label>
                                    <input id="description" name="description" class="form-control"
                                           placeholder="Описание"
                                           required value="{{ old('description', $item->description) }}" type="text">
                                </div>
                            </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Отмена</a>
                    <input type="submit" value="Добавить" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>

@endsection
