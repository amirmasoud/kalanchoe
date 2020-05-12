<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class User extends Controller
{
    public static function avatar()
    {
        echo get_avatar(get_the_author_meta('ID'), '32', '', get_author_posts_url('display_name') . ' avatar', array('class' => array('rounded-full')));
    }
}
