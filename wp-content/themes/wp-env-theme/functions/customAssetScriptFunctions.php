<?php

// --------------------------------------------------
// Assets
// --------------------------------------------------

function wp_env_is_vite_dev(): bool
{
    return file_exists(
        get_stylesheet_directory() . '/vite.dev'
    );
}

function wp_env_theme_assets()
{
    $viteUrl = 'http://localhost:5173';

    if (!wp_env_is_vite_dev()) {
        // ---------- PROD ----------
        wp_enqueue_style(
            'theme-style',
            get_stylesheet_directory_uri() . '/assets/dist/style.css',
            [],
            filemtime(get_stylesheet_directory() . '/assets/dist/style.css')
        );

        wp_enqueue_script(
            'theme-main',
            get_stylesheet_directory_uri() . '/assets/dist/main.js',
            [],
            filemtime(get_stylesheet_directory() . '/assets/dist/main.js'),
            true
        );

        return;
    }

    // ---------- DEV (Vite) ----------
    wp_enqueue_script(
        'vite-client',
        $viteUrl . '/@vite/client',
        [],
        null,
        true
    );

    wp_enqueue_script(
        'theme-main',
        $viteUrl . '/js/main.js',
        [],
        null,
        true
    );

    add_filter('script_loader_tag', function ($tag, $handle, $src) {
        if (in_array($handle, ['vite-client', 'theme-main'], true)) {
            return '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }, 10, 3);
}

add_action('wp_enqueue_scripts', 'wp_env_theme_assets');