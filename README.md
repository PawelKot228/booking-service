

## Installation

Clone project, navigate to the project directory and configure .env file before starting anything.
After finishing configuring run following commands to install dependencies, generate key and link storage to public folder

```shell
composer install
npm i
npm run build

php artisan key:generate
php artisan storage:link
````

Run migration (Application has seeders configured so it is highly recommended to run migrations with --seed flag)
```shell
php artisan migrate
```

Seeders create default user & admin account using following credentials:
```text
login: text@example.com
password: password
```

### Developing

Compiling front changes can be done by using vite's default npm script:
```shell
npm run dev
```
