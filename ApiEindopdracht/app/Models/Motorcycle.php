<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $table = 'motorcycles';

    protected $fillable = [
        'brand',
        'model',
        'year',
        'horsepower',
    ];

    public $timestamps = false;
}
