<?php namespace App\Services;

use App\Repositories\ProjectRepository;
use DB;
use Geocoder;
use Illuminate\Http\Request;

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


           // $data = Geocoder::getCoordinatesForAddress('Infinite Loop 1, Cupertino');

           // dd($data);

            $this->projectRepository->store($request);



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
}