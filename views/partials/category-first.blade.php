@unless (empty($category = Category::first()))
    <a
        class="badge badge-indigo mr-2"
        href="{{ $category['link'] }}"
    >
        {{ $category['name'] }}
    </a>
@endunless
