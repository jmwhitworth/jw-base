<?php

namespace jackwhitworth\hooks;

/**
 * Set the default options for redirection to ignore case,
 * ignore trailing slash, and pass through any query string
 */
function redirectDefaultOptions(array $options): array
{
    return array_merge($options, [
        'flag_query' => 'pass',
        'flag_case' => 1,
        'flag_trailing' => 1,
    ]);
}
\add_filter('red_default_options', 'jackwhitworth\hooks\redirectDefaultOptions', 10);

/**
 * Prevent infinite redirect loops by disabling a redirect
 * with the same source as target
 */
function redirectPreventLoops($target, $current):string|bool
{
    if ($target === $current) {
        \Red_Item::disable_where_matches($target);
        return false;
    }
    return $target;
}
\add_filter('redirection_url_target', 'jackwhitworth\hooks\redirectPreventLoops', 10, 2);
