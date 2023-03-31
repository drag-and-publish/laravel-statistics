<?php

namespace LaravelReady\Statistics\Traits;

use LaravelReady\Statistics\Models\Statistic;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Statisticable
{
    /**
     * Shortable model polymorphic relationship
     */
    public function statisticable(): MorphOne
    {
        return $this->morphOne(Statistic::class, 'shortable');
    }
}
