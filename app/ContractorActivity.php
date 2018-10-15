<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractorActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contractor_id', 'description', 'reminder', 'remind_on', 'action_taken',
        'customer_remarks', 'bde_remarks',
    ];
}
