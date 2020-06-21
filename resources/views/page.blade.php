@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-4 mb-16">
    @while(have_posts()) @php the_post() @endphp
      @include('partials.page-header')
      @include('partials.content-page')
    @endwhile
  </div>
@endsection
