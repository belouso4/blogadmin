@foreach ($items as $item)
    <li class="item-p">
        <a href="{{ route('blog.admin.categories.edit',$item->id) }}" class="list-group-item link-muted">
            {{$item->title}}
        </a>
        <span>
            @if (!$item->hasChildren())
                <a href="{{ url("/admin/categories/mydel?id=$item->id") }}" class="delete">
                    <i class="fas fa-times text-danger"></i>
                </a>
            @else
                <i class="fas fa-times text-close"></i>
            @endif
        </span>

         @if ($item->hasChildren())
            <ol class="list-group">
                @include(env('THEME').'blog.admin.category.menu.customMenuItems', ['items' => $item->children()])
            </ol>
        @endif

    </li>
@endforeach
