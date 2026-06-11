#!/bin/bash
echo "🧼 Cleaning Laravel cache overrides..."
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/packages.php
rm -f bootstrap/cache/services.php

echo "⚙️ Forcing clean package discovery..."
php artisan config:clear
php artisan cache:clear
php artisan package:discover

echo "📦 Regenerating Composer mapping..."
composer dump-autoload

echo "✅ System ready! Running test boost update..."
php artisan boost:update --ansi
