<?php
/**
 * Created by PhpStorm.
 * User: sapnamishra
 * Date: 24/10/18
 * Time: 10:41 PM
 */

namespace App\Services;


use App\Repositories\PackageRepository;
use Illuminate\Http\Request;
use DB;

class PackageService
{
    protected $packageRepository;

    public function __construct()
    {
        $this->packageRepository = new PackageRepository();
    }

    public function all()
    {
        return $this->packageRepository->all();
    }

    public function store(Request $request)
    {
        $input = array(
            'package_name' => $request->package_name,
            'status' => 'N'
        );

        return $this->packageRepository->store($input);
    }

    public function destroy($id)
    {
        $this->packageRepository->destroy($id);
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return $this->packageRepository->show($id);
    }

    public function attachContractor(Request $request)
    {
        $this->packageRepository->attachContractor($request->package_id, $request->contractor_id);
        return true;
    }

    public function attachProject(Request $request)
    {
        $this->packageRepository->attachProject($request->package_id, $request->project_id);
        return true;
    }
}