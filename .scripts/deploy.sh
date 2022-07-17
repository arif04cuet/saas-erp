#!/bin/bash
set -e
sudo update-alternatives --set php /usr/bin/php8.1
#alias php='/usr/local/bin/ea-php80'

echo "Deployment started ..."

# Enter maintenance mode or return true
# if already is in maintenance mode
(php artisan down) || true

# Pull the latest version of the app
#git pull origin main

# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan cache:clear

#install packagess
#npm install
# Compile npm assets
#npm run prod

# Run database migrations
php artisan migrate --force

#set permission
chown $USER:www-data storage -R
chmod 777 storage -R

# Exit maintenance mode
php artisan up

sudo update-alternatives --set php /usr/bin/php7.4
#alias php='/usr/local/bin/ea-php74'
#done
echo "Deployment finished!"
