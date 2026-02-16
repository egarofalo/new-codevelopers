<?php

namespace Codevelopers\Fullstack\Env;

/**
 * Set the constant ENV.
 * - local (local environment)
 * - dev (development or testing environment)
 * - dist (production environment)
 */
define(
    'ENV',
    filter_input(INPUT_ENV, 'ENVIRONMENT', FILTER_VALIDATE_REGEXP, [
        'options' => [
            'default' => 'local',
            'regexp' => '/^(local|dev|dist)$/'
        ]
    ])
);

/**
 * Get environment configuration.
 */
$env_file = __DIR__ . '/env.' . ENV . '.php';
$config = file_exists($env_file) ? include $env_file : [];

/**
 * Retrieves the value of an environment variable or the default value.
 */
function get_env($key, $default = "", int $filter = FILTER_DEFAULT)
{
    global $config;
    $value = isset($_ENV[$key]) ? $_ENV[$key] : (isset($config[$key]) ? $config[$key] : $default);

    return filter_var($value, $filter);
};
