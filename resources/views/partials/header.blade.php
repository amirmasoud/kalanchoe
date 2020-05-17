<header class="banner">
  <div class="container mx-auto">
    <div class="flex flex-wrap">
      <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
      <span>{{ get_bloginfo('description', 'display') }}</span>
      {{ get_search_form() }}
      <nav class="nav-social">
        @if (has_nav_menu('social_navigation'))
          {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav_social']) !!}
        @endif
      </nav>
    </div>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
