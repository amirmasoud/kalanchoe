@foreach (Tag::all() as $tag)
    <a
        class="mr-2"
        href="{{ $tag['link'] }}"
    >
        {{ $tag['name'] }}
    </a>
@endforeach
