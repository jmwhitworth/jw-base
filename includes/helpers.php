<?php 

/**
 * Die and dump shorthand
 */
function dd(...$data): void
{
    if (extension_loaded('xdebug')) {
        var_dump(...$data);
    } else {
        echo '<pre>';
        var_dump(...$data);
        echo '</pre>';
    }
    die();
}

/**
 * Inserts an array before a given key in an array. If the key isn't found, the array is appended to the end
 */
function arrayInsertBeforeKey(array $array, string $key, array $new): array
{
    $keys = array_keys($array);

    // If the key is found, insert the new array before it
    if ($pos = array_search($key, $keys)) {
        return array_merge(array_slice($array, 0, $pos), $new, array_slice($array, $pos));
    }
    
    // If the key is not found, just append the new array to the end
    return array_merge($array, $new);
}
