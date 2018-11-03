<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'completion_date', 'address','name', 'latitude', 'longitude', 'status', 'user_id', 'created_by',
    ];

    /**
     * Get the PMC record associated with the project.
     */
    public function pmc()
    {
        return $this->belongsTo('App\Pmc');
    }

    /**
     * Get the Client record associated with the project.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * The package that belong to the project.
     */
    public function packages()
    {
        return $this->belongsToMany('App\Package', 'package_project');
    }

    /**
     * Get the user that owns the project.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
