<?php

namespace LaravelReady\Statistics\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statistic extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->table = 'statistics';

        parent::__construct($attributes);
    }

    protected $table = 'statistics';

    protected $fillable = [
        'statisticable_type',
        'statisticable_id',
        'ip',
        'ua_header',
        'city',
        'country',
        'country_alpha2',
        'client',
        'client_type',
        'client_version',
        'client_hash',
        'browser_lang',
        'referrer',
        'views',
        'is_bot',
        'is_touchable',
        'is_mobile',
        'is_desktop',
        'device_type',
        'device_brand',
        'device_model',
        'os_name',
        'os_version',
        'platform',
    ];

    protected $casts = [
        'is_bot' => 'boolean',
        'is_touchable' => 'datetime',
        'is_mobile' => 'boolean',
        'is_desktop' => 'boolean',
    ];
}
