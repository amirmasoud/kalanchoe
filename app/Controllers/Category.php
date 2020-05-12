<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Category extends Controller
{
    public static function first()
    {
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<a class="p-1 bg-indigo-300 text-white text-xs font-thin rounded" href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
        }
    }
}
