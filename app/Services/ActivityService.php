<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 04/11/18
 * Time: 11:04 PM
 */

namespace App\Services;


use App\Repositories\ActivityRepository;
use Illuminate\Http\Request;
use App\Activity;

class ActivityService
{

    protected $activityRepository;

    public function __construct()
    {
        $this->activityRepository = new ActivityRepository();
    }

    public function store(Request $request)
    {
        $activityType = $request->resource_type;

        $input = null;

        switch ($activityType){
            case Activity::ACTIVITY_PROJECT:
                $input = array(
                    'project_id' => $request->resource_id,
                    'description' => $request->description,
                    'reminder' => $request->reminder,
                    'remind_on' => $request->remind_on,
                    'action_taken' => $request->action_taken,
                    'customer_remarks' => $request->customer_remarks,
                    'bde_remarks' => $request->bde_remarks
                );
                break;
            case Activity::ACTIVITY_PACKAGE:
                $input = array(
                    'package_id' => $request->resource_id,
                    'description' => $request->description,
                    'reminder' => $request->reminder,
                    'remind_on' => $request->remind_on,
                    'action_taken' => $request->action_taken,
                    'customer_remarks' => $request->customer_remarks,
                    'bde_remarks' => $request->bde_remarks
                );
                break;
            case Activity::ACTIVITY_CONTRACTOR:
                $input = array(
                    'contractor_id' => $request->resource_id,
                    'description' => $request->description,
                    'reminder' => $request->reminder,
                    'remind_on' => $request->remind_on,
                    'action_taken' => $request->action_taken,
                    'customer_remarks' => $request->customer_remarks,
                    'bde_remarks' => $request->bde_remarks
                );
                break;
            default:
                break;
        }

        return $this->activityRepository->store($activityType, $input);



    }
}