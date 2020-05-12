@foreach(Helpers\Category::first() as $category)
    <a
        class="badge badge-indigo"
        href="{{ $category['link'] }}"
    >
        {{ $category['name'] }}
    </a>
@endif
