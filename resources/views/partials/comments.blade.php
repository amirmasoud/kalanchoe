@php
if (post_password_required()) {
  return;
}
@endphp

<section id="comments" class="comments flex flex-wrap max-w-3xl mx-auto mt-20">
  @if (have_comments())
    <p class="block w-full text-right text-gray-500 uppercase text-sm -mb-3">
      {!! sprintf(_nx('One response', '%1$s responses', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number())) !!}
    </p>

    <ol class="comment-list">
      {!! wp_list_comments(['style' => 'ol', 'short_ping' => true]) !!}
    </ol>

    @if (get_comment_pages_count() > 1 && get_option('page_comments'))
      <nav>
        <ul class="pager">
          @if (get_previous_comments_link())
            <li class="previous">@php previous_comments_link(__('&larr; Older comments', 'sage')) @endphp</li>
          @endif
          @if (get_next_comments_link())
            <li class="next">@php next_comments_link(__('Newer comments &rarr;', 'sage')) @endphp</li>
          @endif
        </ul>
      </nav>
    @endif
  @endif

  @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
    <div class="alert alert-warning">
      {{ __('Comments are closed.', 'sage') }}
    </div>
  @endif

  @php comment_form() @endphp
</section>
