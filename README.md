# Statistics

[![Statistics](https://preview.dragon-code.pro/LaravelReady/statistics.svg?brand=laravel)](https://github.com/laravel-ready/statistics)

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## 📂 About
Ready to use Laravel statistic package...

## 📦 Installation

Get via composer

```bash
composer require laravel-ready/statistics
```

## ⚙️ Configs

```bash
php artisan vendor:publish --tag=statistics-config
```
## Migrations

```bash
# publish migrations
php artisan vendor:publish --tag=statistics-migrations

# apply migrations
php artisan migrate --path=/database/migrations/laravel-ready/statistics
```

## 📝 Usage

Add `Statisticable` trait to your model

```php
use LaravelReady\Statistics\Traits\Statisticable;

class Post extends Model
{
    use Statisticable;
}
```

Then call `touch` or `hit` method to run statistic mechanism

```php
use LaravelReady\Statistics\Supports\Statistic;

Statistic::touch($model); // process data then save it
Statistic::hit($model); // just saves raw data without processing (then you can process it later with jobs)
``` 

Access statistic data

```php
$stats = $model->load('statistics');
```

Process statistic data with scheduled command (or you can use `LaravelReady\Statistics\Jobs\ProcessStatistic` job)

```php
<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('statistics:process')->everyMinute();
    }
...
```

## 🐳 Docker Configs

İf you want to use ip2location database, you can use docker image.

### Environment Variables

Define your environment variables in `.env` file (your laravel project)

```yml
# ip2location
IP2LOCATION_TOKEN={YOUR_TOKEN}
IP2LOCATION_CODE=DB11-LITE
IP2LOCATION_IP_TYPE=BOTH
IP2LOCATION_MYSQL_PORT=1010
IP2LOCATION_MYSQL_HOST=127.0.0.1
IP2LOCATION_MYSQL_DBNAME=ip2location_database
IP2LOCATION_MYSQL_USERNAME=admin
IP2LOCATION_MYSQL_PASSWORD=secret
```

### Docker Compose

Create `docker-compose.yml` file in your laravel project

```yml
version: "3.8"

services:
    # ip2location server
    ip2location_mysql:
        image: ip2location/mysql:latest
        container_name: ip2location_mysql
        restart: unless-stopped
        ports:
            - ${IP2LOCATION_MYSQL_PORT}:3306
        environment:
            TOKEN: ${IP2LOCATION_TOKEN}
            CODE: ${IP2LOCATION_CODE}
            IP_TYPE: ${IP2LOCATION_IP_TYPE}
            MYSQL_PASSWORD: ${IP2LOCATION_MYSQL_PASSWORD}
        networks:
            - mysql_net

networks:
    mysql_net:
        driver: bridge
```

Run docker containers

```bash
docker-compose up -d
```

Then wait for ip2location database to be downloaded (*this may some time*).

## ⚓Credits

- This project was generated by the **[packager](https://github.com/laravel-ready/packager)**.

[badge_downloads]: https://img.shields.io/packagist/dt/laravel-ready/statistics.svg?style=flat-square

[badge_license]: https://img.shields.io/packagist/l/laravel-ready/statistics.svg?style=flat-square

[badge_stable]: https://img.shields.io/github/v/release/laravel-ready/statistics?label=stable&style=flat-square

[badge_unstable]: https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]: LICENSE

[link_packagist]: https://packagist.org/packages/laravel-ready/statistics
