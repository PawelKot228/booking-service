

## Installation

Clone project, navigate to the project directory and run following commands.

```shell
composer install
npm i
npm run build

php artisan key:generate
php artisan storage:link
````

Now you can configure .env file and then run migrations 
(This application has seeders so it is recommended to run migrations with --seed flag).

```shell
php artisan migrate
```

### Developing

Compiling front changes can be done by using vite's default npm script:
```shell
npm run dev
```