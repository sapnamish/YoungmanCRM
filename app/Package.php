<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_name', 'status',
    ];

    /**
     * The Projects that belong to the Package.
     */
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'package_project');
    }

    public function activity()
    {
        return $this->hasMany('App\PackageActivity');
    }
}
