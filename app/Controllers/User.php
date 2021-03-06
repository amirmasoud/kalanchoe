<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class User extends Controller
{
    /**
     * Get user's avatar
     *
     * @return string
     */
    public static function avatar()
    {
        return get_avatar(
            get_the_author_meta('ID'),
            '32',
            '',
            get_author_posts_url('display_name') . ' avatar'
        );
    }
}
