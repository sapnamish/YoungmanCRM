<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 04/11/18
 * Time: 11:06 PM
 */

namespace App\Repositories;
use App\Activity;
use App\ProjectActivity;
use App\ContractorActivity;
use App\PackageActivity;

class ActivityRepository
{

    public function all($activityType, $resourceId)
    {
        $activity = null;
        switch ($activityType){
            case Activity::ACTIVITY_PROJECT:
                $activity = ProjectActivity::where('project_id', $resourceId);
                break;
            case Activity::ACTIVITY_PACKAGE:
                $activity = PackageActivity::where('package_id', $resourceId);
                break;
            case Activity::ACTIVITY_CONTRACTOR:
                $activity = ContractorActivity::where('contractor_id', $resourceId);
                break;
            default:
                break;
        }

        return $activity;
    }

    public function store($activityType, $input)
    {
        $activity = null;
        switch ($activityType){
            case Activity::ACTIVITY_PROJECT:
                $activity = new ProjectActivity($input);
                break;
            case Activity::ACTIVITY_PACKAGE:
                $activity = new PackageActivity($input);
                break;
            case Activity::ACTIVITY_CONTRACTOR:
                $activity = new ContractorActivity($input);
                break;
            default:
                break;
        }

        if($activity->save()){
            return array(
                'status' => $activity->id,
                'error' => null
            );
        }
        return array(
            'status' => 'error',
            'error' => "The activity could not be saved"
        );
    }
}