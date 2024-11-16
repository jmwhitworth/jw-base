<?php

namespace jackwhitworth\hooks;


/**
 * Removes the 'Archives:' in the archive titles
 * Source: https://developer.wordpress.org/reference/functions/get_the_archive_title/
 */
function removeArchivePrefix(string $title): string
{
    if ( \is_post_type_archive() ) {
        $title = \post_type_archive_title( '', false );
    }
    return $title;
}
\add_filter( 'get_the_archive_title', '\jackwhitworth\hooks\removeArchivePrefix' );
