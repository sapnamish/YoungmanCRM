<?php namespace App\Services;

use App\Project;
use App\Repositories\ProjectRepository;
use DB;
use Geocoder;
use Illuminate\Http\Request;
use Auth;

class ProjectService
{
    protected $projectRepository;

    public function __construct()
    {
        $this->projectRepository = new ProjectRepository();
    }

    public function all()
    {
        return $this->projectRepository->all();
    }

    public function store(Request $request)
    {

            $location_data = Geocoder::getCoordinatesForAddress($request->address);

            $input = array(
                'name'=> $request->name,
                'completion_date' => $request->completion_date,
                'address' => $location_data['formatted_address'],
                'latitude' => $location_data['lat'],
                'longitude' =>$location_data['lng'],
                'status' => 'N',
                'pmc_id' => null,
                'client_id' => null,
                'user_id' => Auth::user()->id,
                'created_by' => Auth::user()->id
            );

        DB::transaction(function() use ($input)
        {
            $lastInsertId = $this->projectRepository->store($input);
            $this->projectRepository->logProjectStatus($lastInsertId,Project::STATUS_NEW, "");
        });

    }

    public function destroy($id)
    {
        $this->projectRepository->destroy($id);
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return $this->projectRepository->show($id);
    }

    public function attachPMC(Request $request)
    {
        $this->projectRepository->attachPMC($request->pmc_id, $request->project_id);
    }

    public function attachClient(Request $request)
    {
        $this->projectRepository->attachClient($request->client_id, $request->project_id);
    }

    public function updateStatus(Request $request)
    {
        $status_raw = $request->status;
        $project_id = $request->project_id;
        $comments = $request->comment;
        if($comments == null) $comments = "";
        $status = null;

        try{
            switch($status_raw)
            {
                case 'N':
                    $status = Project::STATUS_NEW;
                    break;
                case 'W':
                    $status = Project::STATUS_WON;
                    break;
                case 'R':
                    $status = Project::STATUS_REJECTED;
                    break;
                case 'H':
                    $status = Project::STATUS_HOT;
                    break;
                default:
                    throw new \Exception("Invalid project status code");
                    break;
            }

            DB::transaction(function() use ($project_id, $status, $comments)
            {
                $this->projectRepository->updateStatus($project_id, $status);
                $this->projectRepository->logProjectStatus($project_id,$status, $comments);
            });

            return true;
        }
        catch (\Exception $e){
            return false;
        }

    }
}