<header class="banner my-12">
  <div class="container mx-auto">
    <div class="flex flex-wrap">
      <div class="flex w-full items-baseline justify-center md:justify-start md:w-1/2">
        <a class="brand font-serif font-bold text-3xl mx-4 text-black" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
        <span class="italic font-light text-sm">{{ get_bloginfo('description', 'display') }}</span>
      </div>
      <div class="flex justify-center md:justify-end align-center w-full mt-8 md:w-1/2 md:mt-0">
        {{ get_search_form() }}
        <nav class="nav-social flex items-center">
          @if (has_nav_menu('social_navigation'))
            {!! wp_nav_menu(['theme_location' => 'social_navigation', 'menu_class' => 'nav_social']) !!}
          @endif
        </nav>
      </div>
    </div>
    <nav class="nav-primary mt-12">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
