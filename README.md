## Job application project - Parlador Ideal API

The front-end  APP can be found here: https://github.com/fssAlbertoLuis/parlador-ideal-app

This project was created during a job application test. 

This is an API for a microblogging react native app made in PHP with Laravel Framework. 

------------------------------

Esse projeto foi criado durante um teste emprego. 
O projeto consiste de uma API para um aplicativo de microblogging react native feito com PHP e Laravel framework.

------------------------------

#### install dependencies
```
composer install
```

#### Generate application key (need to copy .env.example to .env)
```
php artisan key:generate
```

Once copied env file, change database credentials and database name to match your db configs

#### Generate JWT key
```
php artisan jwt:secret
```

#### db migrations
```
php artisan migrate --seed
```

#### serve app
```
php artisan serve
```