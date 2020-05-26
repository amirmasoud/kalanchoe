<article @php post_class() @endphp>
  @if (has_post_thumbnail())
  <header class="flex flex-wrap container px-4 mx-auto flex-col-reverse md:flex-row justify-between mb-20">
    <div class="w-full md:w-1/2">
      <div class="w-full mb-4">@include('partials/category-all')</div>
      <h1 class="entry-title text-5xl md:mr-12">{!! get_the_title() !!}</h1>
      <div class="entry-excerpt mt-12 md:mr-12 text-lg">
        @php the_excerpt() @endphp
      </div>
    </div>
    {!! Post::thumbnail('w-full md:w-1/2 h-full') !!}
  </header>
  @else
  <header class="flex flex-wrap container px-4 mx-auto justify-between mb-20">
    <div class="w-full">
      <div class="w-full mb-4">@include('partials/category-all')</div>
      <h1 class="entry-title text-5xl md:mr-12">{!! get_the_title() !!}</h1>
      <div class="entry-excerpt mt-12 md:mr-12 text-lg">
        @php the_excerpt() @endphp
      </div>
    </div>
  </header>
  @endif
  <div class="entry-content flex flex-wrap container mx-auto text-lg">
    @php the_content() @endphp
  </div>
  <footer class="flex flex-wrap max-w-3xl mx-auto">
    <div class="flex w-full justify-between">
      <div class="w-full md:w-2/3">@include('partials/tag-all')</div>
      <div class="w-full md:w-1/3 text-right">@include('partials/entry-time')</div>
    </div>
    <div class="w-full">
      {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </div>
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
