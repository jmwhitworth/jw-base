<?php

namespace jackwhitworth\hooks;

/**
 * Returns the name of the current page, accounting for blog home and archives
 */
function pageTitle(): string
{
    if (\is_home()) {
        return 'Blog posts';
    }
    if (\is_archive()) {
        return \get_the_archive_title();
    }
    if (\is_404()) {
        return '404: Page not found';
    }
    return \get_the_title();
}
\add_shortcode('jackwhitworth_pageTitle', '\jackwhitworth\hooks\pageTitle');
