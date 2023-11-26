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

dd($stats->statistics->toArray());
```

## ⚓Credits

- This project was generated by the **[packager](https://github.com/laravel-ready/packager)**.

[badge_downloads]: https://img.shields.io/packagist/dt/laravel-ready/statistics.svg?style=flat-square

[badge_license]: https://img.shields.io/packagist/l/laravel-ready/statistics.svg?style=flat-square

[badge_stable]: https://img.shields.io/github/v/release/laravel-ready/statistics?label=stable&style=flat-square

[badge_unstable]: https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_license]: LICENSE

[link_packagist]: https://packagist.org/packages/laravel-ready/statistics
