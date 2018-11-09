<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const ACTIVITY_PROJECT = 'projectActivity';
    const ACTIVITY_CONTRACTOR = 'contractorActivity';
    const ACTIVITY_PACKAGE = 'packageActivity';
}
