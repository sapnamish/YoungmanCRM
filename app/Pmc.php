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
        'name', 'email', 'phone_number',
    ];

    /**
     * Get the Project that owns the Pmc.
     */
    public function pmc()
    {
        return $this->belongsToMany('App\Project');
    }
}
