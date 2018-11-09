<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'city', 'state_code',
    ];

    public function activity()
    {
        return $this->hasMany('App\ContractorActivity');
    }
}
