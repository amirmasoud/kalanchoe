<?php

namespace App\Controllers\Partials;

use Sober\Controller\Controller;

class Post extends Controller
{
    public static function thumbnail()
    {
        return the_post_thumbnail('post-thumbnail', ['class' => 'mb-4 object-cover h-40 w-full rounded shadow-md']);
    }
}
