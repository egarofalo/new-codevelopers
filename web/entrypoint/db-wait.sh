#!/bin/bash
set -e

# Wait for MySQL service.
until mysqladmin ping -h db -proot_password --skip-ssl --silent; do
  echo "Waiting for MySQL to be available..."
  sleep 2
done