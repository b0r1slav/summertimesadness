## System Requirements
To be able to run summertimesadness you have to meet the following requirements:
- PHP > 7.0
- PHP Extensions: OpenSSL, PDO, Mbstring, Tokenizer, Mcrypt, XML, Ctype, JSON
- Node.js > 6.0
- Composer > 1.0.0

## Installation
1. Install Composer using detailed installation instructions [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
2. Install Node.js using detailed installation instructions [here](https://nodejs.org/en/download/package-manager/)
3. Clone repository
```
$ git clone https://github.com/b0r1slav/summertimesadness.git
```
4. Change into the working directory
```
$ cd summertimesadness
```
5. Copy `.env.example` to `.env` and modify according to your environment
```
$ cp .env.example .env
```
6. Install composer dependencies
```
$ composer install --prefer-dist
```
7. An application key can be generated with the command
```
$ php artisan key:generate
```
8. Set permissions for Laravel folders
```
$ chmod -R 777 storage bootstrap/cache
```
9. Execute following commands to install other dependencies
```
$ npm install
$ npm run dev
```
10. Run these commands to create the tables within the defined database and populate seed data
```
$ php artisan migrate --seed
$ php artisan module:db:seed improvement
```

Seeds: `admin@summertimesadness.com|1234567`, `mardolina@summertimesadness.com|lazy123`

If you get an error like a `PDOException` try editing your `.env` file and change `DB_HOST=127.0.0.1` to `DB_HOST=localhost` or `DB_HOST=mysql` (for *docker-compose* environment).

## Run

To start the PHP built-in server
```
$ php artisan serve --port=8080
or
$ php -S localhost:8080 -t public/
```

Now you can browse the site at [http://localhost:8080](http://localhost:8080)  🙌