


{{--<ol class="breadcrumb">--}}

{{--    @if (isset($category))--}}
{{--        <li><a href="{{ route('blog.admin.categories.index') }}"><i class="fa fa-dashboard"></i>{{ $category }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($user))--}}
{{--        <li><a href="{{ route('blog.admin.users.index') }}"><i class="fa fa-dashboard"></i>{{ $user }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($order))--}}
{{--        <li><a href="{{ route('blog.admin.orders.index') }}"><i class="fa fa-dashboard"></i>{{ $order }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($product))--}}
{{--        <li><a href="{{ route('blog.admin.products.index') }}"><i class="fa fa-dashboard"></i>{{ $product }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($group_filter))--}}
{{--        <li><a href="{{ url('admin/filter/group-filter') }}"><i class="fa fa-dashboard"></i>{{ $group_filter }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($attrs_filter))--}}
{{--        <li><a href="{{ url('admin/filter/attributes-filter') }}"><i class="fa fa-dashboard"></i>{{ $attrs_filter }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($currency))--}}
{{--        <li><a href="{{ url('admin/currency/index') }}"><i class="fa fa-dashboard"></i>{{ $currency }}</a></li>--}}
{{--    @endif--}}
{{--    @if (isset($active))--}}
{{--        <li style="display: inline-block;"><i style="margin-right: 5px;" class="fa fa-dashboard"></i>{{ $active }}</li>--}}
{{--    @endif--}}
{{--</ol>--}}
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @if (isset($title)) <h1 class="m-0 text-dark">{{ $title }}</h1> @endif
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @if (isset($parent))
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}"><i class="fa fa-dashboard"></i>{{ $parent }}</a></li>
                        @endif
                        @if (isset($category))
                            <li class="breadcrumb-item"><a href="{{ route('blog.admin.categories.index') }}"><i class="fa fa-dashboard"></i>{{ $category }}</a></li>
                        @endif
                        @if (isset($post))
                            <li class="breadcrumb-item"><a href="{{ route('blog.admin.posts.index') }}"><i class="fa fa-dashboard"></i>{{ $post }}</a></li>
                        @endif
                        @if (isset($active))
                            <li class="breadcrumb-item active"><i style="margin-right: 5px;" class="fa fa-dashboard"></i>{{ $active }}</li>
                        @endif
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

