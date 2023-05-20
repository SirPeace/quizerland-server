### Start up

Project requires [Docker](https://www.docker.com/) to be installed

In project's folder run these commands (bash):
```
$ cp .env.example .env
$ docker-compose exec server bash
```

Then inside the running container:
```
# composer install
# php artisan key:generate
# touch database/database.sqlite
# php artisan migrate
# php artisan db:seed
# exit
```

Then once again in the project folder restart the container:
```
$ ./vendor/bin/sail up -d
```

Server is now available on the port: **8000**
Documentation: _localhost:8000/api/documentation_

✌️ Happy coding!
