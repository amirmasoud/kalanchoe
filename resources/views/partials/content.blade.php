<article @php post_class('w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-2') @endphp>
  <header>
    @php the_post_thumbnail() @endphp
    {!! Category::first() !!}
    @include('partials/entry-meta')
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
  </header>
  <div class="entry-summary">
    @php the_excerpt() @endphp
  </div>
</article>
