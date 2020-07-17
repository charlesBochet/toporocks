<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use MStaack\LaravelPostgis\Eloquent\PostgisTrait;

class Route  extends Model
{
    use PostgisTrait;

    protected $postgisFields = [
        'location'
    ];
}
