<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolsCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_name', 'description',
    ];
}
