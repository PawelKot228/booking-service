# Booking service
Application for booking appointments from various providers (ex. Hairstylist etc.).

As it's base is used TALL stack (Jetstream livewire) with [flowbite](https://flowbite.com/) for more css components

## Installation

Clone project, navigate to the project directory and configure .env file before starting anything.
After finishing configuring run following commands to install dependencies, generate key and link storage to public folder

Env additional variables that might be necessary:
```env
VITE_GOOGLE_MAPS_KEY="key" #google maps api key necessary for search
```

Installation commands
```shell
composer install
npm i
npm run build

php artisan key:generate
php artisan storage:link
````

Run migration (Application has seeders configured, so it is highly recommended to run migrations with --seed flag)
```shell
php artisan migrate
```

Seeders create default user account using following credentials:
```text
login: text@example.com
password: password
```

### Developing

Compiling front changes can be done by using vite's default npm script:
```shell
npm run dev
```

### Testing
Currently, there are no tests written except the ones already provided for Fortify/Jetstream components.

## To do
* Review index
* Display company gallery
* Finish company search query + pagination
