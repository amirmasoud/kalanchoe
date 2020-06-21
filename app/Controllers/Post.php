<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Post extends Controller
{
    /**
     * Get post thumbnail.
     *
     * @param string|integer $width
     * @param string|integer $height
     * @param string $class
     * @return void
     */
    public static function thumbnail($class)
    {
        return the_post_thumbnail('post-thumbnail', ['class' => $class]);
    }
}
