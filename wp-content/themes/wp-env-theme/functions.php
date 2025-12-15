<?php

if (!defined('ABSPATH')) {
    exit;
}

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');

add_post_type_support('page', 'excerpt');

// Functions
include_once('functions/index.php');


