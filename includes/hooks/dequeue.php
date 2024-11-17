<?php

namespace jackwhitworth\hooks;


/**
 * Dequeues the default jQuery Migrate script.
 */
function dequeueDefaultScripts($scripts)
{
    if (!\is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        if ($script->deps) {
            $script->deps = array_diff($script->deps, ['jquery-Migrate']);
        }
    }
}
\add_action( 'wp_default_scripts', '\jackwhitworth\hooks\dequeueDefaultScripts' );


/**
 * Disables the default WordPress emoji scripts and styles.
 */
function disableEmojis() {
    \remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    \remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    \remove_action( 'wp_print_styles', 'print_emoji_styles' );
    \remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    \remove_action( 'admin_print_styles', 'print_emoji_styles' );
    \remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    \remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    \add_filter( 'tiny_mce_plugins', function ($plugins) {
        if (is_array($plugins)) return array_diff($plugins, ['wpemoji']);
        return [];
    });
}
\add_action( 'init', '\jackwhitworth\hooks\disableEmojis' );
