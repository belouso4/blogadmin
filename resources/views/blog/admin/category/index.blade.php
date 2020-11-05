@extends('blog.admin.app_admin')

@section('content')

    <section class="content-header">
        @component('blog.admin.components.breadcrumb')
            @slot('title') Список категорий @endslot
            @slot('parent')  Главная @endslot
            @slot('active')  Список категорий @endslot
        @endcomponent
    </section>

    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div width="100%">
                    <small style="margin-left: 70px">Для редактирования нажмите на категорию</small>
                    <small style="margin-left: 70px">Невозможно удалить категории имеющие наследника или имеющие посты.</small>
                </div>
            </div>
            <div class="card-body">
                @if ($menu)
                    <ol class="list-group list-group-root well">

                        @include('blog.admin.category.menu.customMenuItems', ['items' => $menu->roots()])

                    </ol>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

@endsection
