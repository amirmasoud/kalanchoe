<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Category extends Controller
{
    /**
     * Return first category Array[link, text] of the given post in the loop,
     * otherwise false.
     *
     * @return Array|Boolean
     */
    public static function first()
    {
        $categories = get_the_category();
        if (!empty($categories)) {
            return array(
                'link' => esc_url(get_category_link($categories[0]->term_id)),
                'name' => esc_html($categories[0]->name)
            );
        } else {
            return array();
        }
    }
}
