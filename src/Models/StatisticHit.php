<?php

namespace LaravelReady\Statistics\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelReady\Statistics\Traits\Statisticable;

class StatisticHit extends Model
{
    use Statisticable;

    public $timestamps = false;

    protected $fillable = [
        'statisticable_type',
        'statisticable_id',
        'ua_header',
        'referrer',
        'ip',
        'date',
    ];
}
