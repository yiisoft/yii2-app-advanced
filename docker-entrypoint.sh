#!/bin/bash
set -e

# Update composer dependencies to match the current PHP version.
# The committed composer.lock may target an older PHP, so a fresh
# update ensures all packages are compatible with the runtime.
if [ -f /app/composer.json ]; then
    echo "Updating Composer dependencies..."
    composer update --no-interaction --prefer-dist --working-dir=/app 2>&1 || true
fi

# Run the default entrypoint (Apache)
exec apache2-foreground
