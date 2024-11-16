<?php

namespace jackwhitworth;

$allFiles = array_merge(
    glob(__DIR__ . '/*.php'),
    glob(__DIR__ . '/**/*.php'),
);

foreach ($allFiles as $file) {
    require_once $file;
}
