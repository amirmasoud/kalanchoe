<article @php post_class() @endphp>
  <header class="flex justify-between mb-20">
    <div class="max-w-(full-64)">
      <div class="w-full mb-4">@include('partials/category-all')</div>
      <h1 class="entry-title text-5xl">{!! get_the_title() !!}</h1>
      <div class="entry-excerpt mt-12 text-lg">
        @php the_excerpt() @endphp
      </div>
    </div>
    {!! Post::thumbnail('64', 'full') !!}
  </header>
  <div class="entry-content text-lg">
    @php the_content() @endphp
  </div>
  <footer class="flex flex-wrap max-w-3xl mx-auto">
    <div class="flex w-full justify-between">
      @include('partials/tag-all')
      @include('partials/entry-time')
    </div>
    <div class="w-full">
      {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </div>
  </footer>
  @php comments_template('/partials/comments.blade.php') @endphp
</article>
