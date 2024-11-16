<?php

if (!defined('JW_DOMAIN')) {
    define('JW_DOMAIN', 'jackwhitworth');
}

if (!defined('JW_BASE_PATH')) {
    define('JW_BASE_PATH', \get_parent_theme_file_path());
}

if (!defined('JW_BASE_URL')) {
    define('JW_BASE_URL', \get_parent_theme_file_uri());
}

require_once 'includes/autoload.php';
