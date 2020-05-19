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
     * @param string $extra
     * @return void
     */
    public static function thumbnail($width = 'full', $height = 40, $extra = '')
    {
        $class = 'mb-4 object-cover rounded shadow-md';
        $class .= " w-$width h-$height $extra";
        return the_post_thumbnail('post-thumbnail', ['class' => $class]);
    }
}
