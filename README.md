# Shopping cart checkout system using Symfony/Workflow and ORM

## Installation
#### Requirements
- `Docker` and `docker-compose`

#### Install
1. Clone the repository and execute
```sh
cd ./docker && docker-compose up --build
```
2. open terminal and enter php container:
```
docker exec -it php bash
composer install
```

3. in browser go to:
```
http://localhost:8888/
```

#### Run tests
```sh
cd app/
```
then
```sh
vendor/bin/phpunit
```
