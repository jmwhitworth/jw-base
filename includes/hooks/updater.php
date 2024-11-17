<?php

namespace jackwhitworth\hooks;

/**
 * Plugin updater handler function.
 * Pings the Github repo that hosts the plugin to check for updates.
 */
function checkThemeUpdate( $transient )
{
    // If no update transient or transient is empty, return.
    if ( empty( $transient->checked ) ) {
        return $transient;
    }

    // Theme slug, path to the theme, and the URL of the update server
    $theme_slug = 'jw-base';
	$basename = basename( \get_template_directory() );
    $update_url = 'https://raw.githubusercontent.com/jmwhitworth/jw-base/refs/heads/main/update-info.json';

    // Fetch update information from your server
    $response = \wp_remote_get( $update_url );
    if ( \is_wp_error( $response ) ) return $transient;

    // Parse the JSON response (update_info.json must return the latest version details)
    $update_info = json_decode( \wp_remote_retrieve_body( $response ) );

    // If a new version is available, modify the transient to reflect the update
    if ( version_compare( $transient->checked[ $theme_slug ], $update_info->new_version, '<' ) ) {
        $transient->response[$basename]['url'] = $update_info->url;
        $transient->response[$basename]['slug'] = 'jw-theme';
        $transient->response[$basename]['package'] = $update_info->package;
        $transient->response[$basename]['new_version'] = $update_info->new_version;
    }

    return $transient;
}

if ( \is_admin() ) {
    \add_filter( 'pre_set_site_transient_update_themes', '\jackwhitworth\hooks\checkThemeUpdate' );
}
