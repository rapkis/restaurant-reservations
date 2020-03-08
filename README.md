## Project setup
### Copy environment file
```
cp .env.example .env
```
### Install composer dependencies
```
composer install
```
### Set up app key
```
php artisan key:generate
```
### Start docker
```
docker-compose up
```
### Add virtual host:
`sudo nano /etc/hosts`  
Insert this line:  
`127.0.0.1 mysql localhost`
### Run migrations
```
php artisan migrate
```
### Set up frontend
```
npm install
npm run watch
```
### It's alive!
