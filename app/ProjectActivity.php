<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id', 'description', 'reminder', 'remind_on', 'action_taken',
        'customer_remarks', 'bde_remarks',
    ];
}
