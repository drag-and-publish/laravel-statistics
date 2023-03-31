<?php

namespace LaravelReady\Statistics\Traits;

use LaravelReady\Statistics\Models\Statistic;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Statisticable
{

    public function statistic(): MorphOne
    {
        return $this->morphOne(Statistic::class, 'statisticable');
    }

    /**
     * Statisticable model polymorphic relationship
     */
    public function statisticable()
    {
        return $this->morphTo();
    }
}
