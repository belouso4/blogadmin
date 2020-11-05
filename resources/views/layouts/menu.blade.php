@foreach ($items as $item)

    <li class="item-p">
        <a href="{{ route('blog.post.category', $item->nickname) }}" class="list-group-item link-muted">
            <img class="icon-right" src="{{ asset('asset/img/arrowhead-pointing-to-the-right.svg') }}" alt="">
            <img class="icon-down" src="{{ asset('asset/img/caret-down.svg') }}" alt="">
            {{$item->title}}

        </a>
        @if ($item->hasChildren())
            <ul class="list-group">
                @include('layouts.menu', ['items' => $item->children()])
            </ul>
        @endif
    </li>
@endforeach

