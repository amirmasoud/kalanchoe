<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Tag extends Controller
{
    /**
     * Return all tags.
     *
     * @return array
     */
    public static function all()
    {
        $tags = get_the_tags();
        if (!empty($tags)) {
            $formatted_tags = array();
            foreach ($tags as $tag) {
                $formatted_tags[] = array(
                    'link' => esc_url(get_tag_link($tag->term_id)),
                    'name' => esc_html($tag->name)
                );
            }
            return $formatted_tags;
        } else {
            return array();
        }
    }
}
