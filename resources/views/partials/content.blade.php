<article @php post_class('flex content-between flex-wrap p-4 mb-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4') @endphp>
  <div class="w-full">
    <header>
      <span class="">
        @include('partials/sticky-pin')
      </span>
      {!! Post::thumbnail() !!}
      @include('partials/category-first')
      @include('partials/entry-time')
      <h2 class="mt-4 mb-2 entry-title text-3xl"><a class="text-black hover:text-indigo-500" href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    </header>
    <div class="entry-summary">
      @php the_excerpt() @endphp
    </div>
  </div>
  <div class="w-full mt-4">
    @include('partials/entry-author')
  </div>
</article>
