# 

## Installation
#### Requirements
- `Docker` and `docker-compose`

#### Install
0. Customize your .docker/.env file if needed other settings
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
