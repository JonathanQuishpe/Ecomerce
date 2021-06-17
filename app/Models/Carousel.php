<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model {

    /**
     * @var string
     */
    protected $table = 'carousels';

    /**
     * @var array
     */
    protected $fillable = ['name', 'logo', 'status'];

}
