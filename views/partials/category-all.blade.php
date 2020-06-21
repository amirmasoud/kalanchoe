@foreach (Category::all() as $category)
    <a
        class="badge badge-indigo mr-2 leading-8"
        href="{{ $category['link'] }}"
    >
        {{ $category['name'] }}
    </a>
@endforeach
