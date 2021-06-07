<?php

namespace App\Queries;

use Laravel\Scout\Builder;

abstract class ScoutQuery
{
    /**
     * Make the query.
     *
     * @return Builder
     */
    abstract public static function make();
}
