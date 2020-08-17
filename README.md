## About the Listing App

This is a simple Listing App which contains only:

- A Listing Search Page
- A Listing Detail Page
- A Create Listing Page

### Technologies used

- Laravel (PHP)
- mariadb
- VueJs

### Packages used

- [BenSampo/laravel-enum](https://github.com/bensampo/laravel-enum)
- [livewire/livewire](https://github.com/livewire/livewire)
- [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary)
- [tightenco/ziggy](https://github.com/tightenco/ziggy)

### Libraries used

- Vue
- ziggy-js
- Tailwind

### Installation

The project runs on docker containers, therefore you'll need ```docker``` and ```docker-compose```.

Clone the project:

```bash
git clone https://github.com/cisco6co/listings.git
```

Copy the docker ```env```:

```bash
cd .docker
```

```bash
cp env-example .env
```

Run the docker containers:

```bash
docker-compose up -d
```

SSH into the workspace container and install dependencies:

```bash
docker-compose exec --user=laradock workspace bash
```

```bash
cp .env.example .env
```

```bash
composer install
```

```bash
php artisan key:generate
```

Run the database migrations:

```bash
php artisan migrate
```

Run the seeders:
```bash
php artisan db:seed
```

Install dependencies using npm

```bash
npm install
```

If you are building for developement:

```bash
npm run serve
```

If you are building for production:

```bash
npm run build
```

You should now be up and running
