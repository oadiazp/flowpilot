# Flowpilot code challenge

## Set up
```
git clone git@github.com:oadiazp/flowpilot.git
cd flowpilot/
docker-compose up
cd api
composer install
./cli.php migrations:migrate
```

To see if everything is working click [here](http://localhost:8080)

## Runing tests

```
docker-compose exec api bash
cd api
./vendor/bin/phpunit
```

