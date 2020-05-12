<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public static function thumbnail()
    {
        echo the_post_thumbnail('post-thumbnail', ['class' => 'mb-4 object-cover h-40 w-full rounded shadow-md']);
    }
}
