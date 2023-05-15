### Start up

In project's folder run these commands (bash):

```
$ ./vendor/bin/sail up -d
$ ./vendor/bin/sail composer install
$ ./vendor/bin/sail artisan key:generate
$ touch database/database.sqlite
$ ./vendor/bin/sail artisan migrate
```
