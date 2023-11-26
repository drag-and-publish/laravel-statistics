<?php

namespace LaravelReady\Statistics\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use LaravelReady\Statistics\Models\Statistic;

trait Statisticable
{

    public function statistics(): MorphMany
    {
        return $this->morphMany(Statistic::class, 'statisticable');
    }

    /**
     * Statisticable model polymorphic relationship
     */
    public function statisticable()
    {
        return $this->morphTo();
    }
}
