php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
php artisan l5-swagger:generate
chmod -R 777 storage
