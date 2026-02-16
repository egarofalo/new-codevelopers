#!/bin/bash
set -e

# Wait for MySQL service.
db-wait.sh

# Setup Apache web server.
apache-setup.sh

# Setup wordpress project.
project-setup.sh

# Restart apache2 and run in foreground.
# This is necessary for the container to keep running and to allow it to handle requests properly.
exec apache2-foreground