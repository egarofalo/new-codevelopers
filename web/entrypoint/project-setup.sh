#!/bin/bash
set -e

# Move to html directory
cd /var/www/html

# Run Composer install.
composer install

# Import database.
php cli database:import

# Install node dependencies with yarn
cd /var/www/html/public/content/themes/${THEME_NAME}
yarn install

# Build assets with Laravel Mix
yarn run dev