<?php namespace App\Services;

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
            $this->projectRepository->store($input);
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
}