<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pmc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
    ];
}
