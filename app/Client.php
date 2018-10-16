<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
    ];

    /**
     * Get the Project that owns the Pmc.
     */
    public function pmc()
    {
        return $this->belongsTo('App\Project');
    }
}
