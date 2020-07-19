@foreach (Category::all() as $category)
    <a
        class="badge badge-indigo mr-2"
        href="{{ $category['link'] }}"
    >
        {{ $category['name'] }}
    </a>
@endforeach
