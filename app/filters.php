<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return '...';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__ . '\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory() . '/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory() . '/index.php';
    }

    return $comments_template;
}, 100);

/**
 * Render social navigation menu
 */
add_filter('wp_nav_menu_items', function ($items, $args) {
    if ($args->theme_location == 'social_navigation') {
        preg_match_all('/(.*?)<a href="(.*?)">(.*?)<\/a>(.*?)/s', $items, $items_preg);
        if (count($items_preg) >= 3) {
            $idx = 0;
            foreach ($items_preg[2] as $link) {
                $host = parse_url($link)['host'];
                if (strpos($host, 'twitter.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 400 400" style="enable-background:new 0 0 400 400;" xml:space="preserve" class="social_navigation-icon twitter-svg"><style type="text/css">.st0{fill:#1DA1F2;}.st1{fill:#FFFFFF;}</style><g id="Dark_Blue"><circle class="st0" cx="200" cy="200" r="200"/></g><g id="Logo__x2014__FIXED"><path class="st1" d="M163.4,305.5c88.7,0,137.2-73.5,137.2-137.2c0-2.1,0-4.2-0.1-6.2c9.4-6.8,17.6-15.3,24.1-25 c-8.6,3.8-17.9,6.4-27.7,7.6c10-6,17.6-15.4,21.2-26.7c-9.3,5.5-19.6,9.5-30.6,11.7c-8.8-9.4-21.3-15.2-35.2-15.2 c-26.6,0-48.2,21.6-48.2,48.2c0,3.8,0.4,7.5,1.3,11c-40.1-2-75.6-21.2-99.4-50.4c-4.1,7.1-6.5,15.4-6.5,24.2 c0,16.7,8.5,31.5,21.5,40.1c-7.9-0.2-15.3-2.4-21.8-6c0,0.2,0,0.4,0,0.6c0,23.4,16.6,42.8,38.7,47.3c-4,1.1-8.3,1.7-12.7,1.7 c-3.1,0-6.1-0.3-9.1-0.9c6.1,19.2,23.9,33.1,45,33.5c-16.5,12.9-37.3,20.6-59.9,20.6c-3.9,0-7.7-0.2-11.5-0.7 C110.8,297.5,136.2,305.5,163.4,305.5"/></g></svg><', $items);
                }

                if (strpos($host, 'facebook.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg fill="#1877F2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon facebook-svg"><path d="M23.9981 11.9991C23.9981 5.37216 18.626 0 11.9991 0C5.37216 0 0 5.37216 0 11.9991C0 17.9882 4.38789 22.9522 10.1242 23.8524V15.4676H7.07758V11.9991H10.1242V9.35553C10.1242 6.34826 11.9156 4.68714 14.6564 4.68714C15.9692 4.68714 17.3424 4.92149 17.3424 4.92149V7.87439H15.8294C14.3388 7.87439 13.8739 8.79933 13.8739 9.74824V11.9991H17.2018L16.6698 15.4676H13.8739V23.8524C19.6103 22.9522 23.9981 17.9882 23.9981 11.9991Z"/></svg><', $items);
                }

                if (strpos($host, 'unsplash.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon unsplash-svg"><path d="M7.5 6.75V0h9v6.75h-9zm9 3.75H24V24H0V10.5h7.5v6.75h9V10.5z"/></svg><', $items);
                }

                if (strpos($host, 'stackoverflow.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg fill="#FE7A16" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon stackoverflow-svg"><title>Stack Overflow icon</title><path d="M18.986 21.865v-6.404h2.134V24H1.844v-8.539h2.13v6.404h15.012zM6.111 19.731H16.85v-2.137H6.111v2.137zm.259-4.852l10.48 2.189.451-2.07-10.478-2.187-.453 2.068zm1.359-5.056l9.705 4.53.903-1.95-9.706-4.53-.902 1.936v.014zm2.715-4.785l8.217 6.855 1.359-1.62-8.216-6.853-1.35 1.617-.01.001zM15.751 0l-1.746 1.294 6.405 8.604 1.746-1.294L15.749 0h.002z"/></svg><', $items);
                }

                if (strpos($host, 'goodreads.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg fill="#663300" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon goodreads-svg"><title>Goodreads icon</title><path d="M19.525 15.977V.49h-2.059v2.906h-.064c-.211-.455-.481-.891-.842-1.307-.36-.412-.767-.777-1.232-1.094-.466-.314-.962-.561-1.519-.736C13.256.09 12.669 0 12.038 0c-1.21 0-2.3.225-3.246.67-.947.447-1.743 1.057-2.385 1.83-.642.773-1.133 1.676-1.47 2.711-.336 1.037-.506 2.129-.506 3.283 0 1.199.141 2.326.425 3.382.286 1.057.737 1.976 1.368 2.762.631.78 1.412 1.397 2.375 1.833.961.436 2.119.661 3.471.661 1.248 0 2.33-.315 3.262-.946s1.638-1.473 2.119-2.525h.061v2.284c0 2.044-.421 3.607-1.264 4.705-.84 1.081-2.224 1.638-4.146 1.638-.572 0-1.128-.061-1.669-.181-.542-.12-1.036-.315-1.487-.57-.437-.271-.827-.601-1.143-1.038-.316-.435-.526-.961-.632-1.593H5.064c.067.887.315 1.654.737 2.3.424.646.961 1.172 1.602 1.593.641.406 1.367.706 2.172.902.811.194 1.639.3 2.494.3 1.383 0 2.541-.195 3.486-.555.947-.376 1.714-.902 2.301-1.608.601-.708 1.021-1.549 1.293-2.556.27-1.007.42-2.134.42-3.367l-.044.062zm-7.484-.557c-.955 0-1.784-.189-2.479-.571-.697-.38-1.277-.882-1.732-1.503-.467-.621-.797-1.332-1.022-2.139s-.332-1.633-.332-2.484c0-.871.105-1.725.301-2.563.21-.84.54-1.587.992-2.24.451-.652 1.037-1.182 1.728-1.584s1.533-.605 2.51-.605 1.803.209 2.495.621c.676.415 1.247.959 1.683 1.634.436.677.751 1.429.947 2.255.195.826.285 1.656.285 2.482 0 .852-.12 1.678-.345 2.484-.226.807-.572 1.518-1.038 2.139-.465.621-1.021 1.123-1.698 1.503-.676.382-1.458.571-2.359.571h.064z"/></svg><', $items);
                }

                if (strpos($host, 'linkedin.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg fill="#0077B5" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon linkedin-svg"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg><', $items);
                }

                if (strpos($host, 'github.com') !== false) {
                    $items = str_replace('>' . $items_preg[3][$idx++] . '<', '><svg fill="#181717" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="social_navigation-icon github-svg"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg><', $items);
                }
            }
        }
        return $items;
    }
    return $items;
}, 10, 2);
