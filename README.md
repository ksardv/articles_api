1. clone the project
2. run `cp .env.example .env` and set your DB parameters
3. run `docker compose up -d`
4. run `docker exec -it articles_api composer install`
5. the api should be accessible on localhost
6. run the migrations `docker exec -it articles_api php bin/console doctrine:migrations:migrate`
7. to run php unit tests:
```
php bin/phpunit
```
8. to run phpcsfixer
9. to run phpstan