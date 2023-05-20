cd /var/www/html
chmod -R 777 storage
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed
php artisan l5-swagger:generate
