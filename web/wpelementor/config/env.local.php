<?php

return [
    # Disable WordPress debug mode
    'DEBUG' => true,
    'DEBUG_LOG' => true,
    'WP_DEBUG_DISPLAY' => true,
    # MySQL connection parameters
    'DB_NAME' => 'codevelopers',
    'DB_USER' => 'root',
    'DB_PASSWORD' => 'root_password',
    'DB_HOST' => 'db',
    # Site root URL
    'SITE_URL' => 'https://localhost:8443',
    # Proxy server parameters
    'PROXY' => false,
    'PROXY_HOST' => '',
    'PROXY_PORT' => '',
    'PROXY_USERNAME' => '',
    'PROXY_PASSWORD' => '',
    'PROXY_EXCLUDED_HOSTS' => '',
    # WordPress automatic updates parameters
    'AUTOMATIC_UPDATER_DISABLED' => true,
    # Enable FS_METHOD direct to allow WordPress to upload plugins and themes
    'FS_METHOD_DIRECT' => true,
];
