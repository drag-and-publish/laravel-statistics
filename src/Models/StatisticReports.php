<?php

namespace LaravelReady\Statistics\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatisticReports extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->table = 'statistic_reports';

        parent::__construct($attributes);
    }

    protected $table = 'statistic_reports';

    protected $fillable = [
        'statisticable_type',
        'statisticable_id',
        'start_date',
        'end_date',
        'type',
        'name',
        'data',
    ];
}
