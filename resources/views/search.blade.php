@extends('layouts.app')

@section('content')
  <div class="container mx-auto my-4">
    @include('partials.page-header')

    @if (!have_posts())
    <div class="alert alert-warning px-4 my-4">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    <div class="m-4">
      {!! get_search_form(false) !!}
    </div>
    @endif
  </div>

  <div class="flex flex-wrap container mx-auto">
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-search')
  @endwhile

  {!! get_the_posts_navigation() !!}
  </div>
@endsection
