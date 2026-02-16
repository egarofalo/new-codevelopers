<?php

namespace Codevelopers\WpElementor\Helpers\String;

/**
 * Concat one or more strings.
 * 
 * @return string
 */
if (!function_exists('str_concat')) {
    function str_concat(string ...$strings): string
    {
        return implode('', $strings);
    }
}
