@extends('layouts.app')

@section('content')
  <div class="container mx-auto">

    <div class="text-center text-4xl">
      @include('partials.page-header')
    </div>

    <div class="px-4 my-16 text-center">
      @if (!have_posts())
        <div class="alert alert-warning">
          {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
        </div>
        <div class="w-48 mx-auto my-8">
          {!! get_search_form(false) !!}
        </div>
      @endif
    </div>
  </div>
@endsection
