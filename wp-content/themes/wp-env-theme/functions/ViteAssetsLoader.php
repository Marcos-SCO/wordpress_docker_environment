<?php 

namespace Functions;

class ViteAssetsLoader
{
    protected static ?ViteAssetsLoader $instance = null;

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'wpThemeAssetsWithVite']);
    }

    protected function isViteInDevelopMode(): bool
    {
        return file_exists(
            get_stylesheet_directory() . '/vite.dev'
        );
    }

    protected function viteManifestAssets(string $entry): array
    {
        $manifestPath = get_stylesheet_directory() . '/assets/dist/.vite/manifest.json';

        if (!is_readable($manifestPath)) {
            return [];
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        return $manifest[$entry] ?? [];
    }


    public function wpThemeAssetsWithVite()
    {
        $viteUrl = 'http://localhost:5173';

        if (!$this->isViteInDevelopMode()) {

            $viteManifestAssets = $this->viteManifestAssets('js/main.js');

            // ---------- PROD ----------
            wp_enqueue_style(
                'theme-style',
                // get_stylesheet_directory_uri() . '/assets/dist/style.css',
                get_stylesheet_directory_uri() . '/assets/dist/' . $viteManifestAssets['css'][0],
                [],
                // filemtime(get_stylesheet_directory() . '/assets/dist/style.css')
            );

            wp_enqueue_script(
                'theme-main',
                // get_stylesheet_directory_uri() . '/assets/dist/main.js',
                get_stylesheet_directory_uri() . '/assets/dist/' . $viteManifestAssets['file'],
                [],
                // filemtime(get_stylesheet_directory() . '/assets/dist/main.js'),
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

    public static function getInstance(): ViteAssetsLoader
    {
        if (null === self::$instance) self::$instance = new self();
        return self::$instance;
    }
}
