# TESTING

Please use the testing features that come with Laravel, PHPUnit and Laravel DUSK

Automatically setup with: `make install`, so please add any other necessary steps in case you change setup

* `docker-compose exec php-fpm t` <-- alias to run `phpunit` from within the `/vendor` folder.
* `docker-compose exec php-fpm php artisan test`
* `docker-compose exec php-fpm php artisan dusk`