@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning px-4 my-4">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    <div class="m-4">
      {!! get_search_form(false) !!}
    </div>
  @endif

  <div class="flex flex-wrap">
  @while (have_posts()) @php the_post() @endphp
    @include('partials.content-'.get_post_type())
  @endwhile
  </div>

  {!! get_the_posts_navigation() !!}
@endsection
