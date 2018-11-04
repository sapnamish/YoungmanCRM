<?php
/**
 * Created by PhpStorm.
 * User: sapnamishra
 * Date: 24/10/18
 * Time: 10:41 PM
 */

namespace App\Repositories;

use DB;
use App\Package;

class PackageRepository
{
    public function all()
    {
        return Package::all();
    }

    public function store($input)
    {
        $contractor = new Package($input);
        $contractor->save();
        return true;
    }

    public function destroy($id)
    {
        $contractor = Package::find($id);
        $contractor->delete();
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return Package::find($id);
    }

    public function attachContractor($packageId, $contractorId)
    {
        DB::insert("INSERT INTO package_contractors (package_id, contractor_id) VALUES(?, ?)", [$packageId, $contractorId]);
    }

    public function attachProject($packageId, $projectId)
    {
        DB::insert("INSERT INTO package_project (package_id, project_id) VALUES(?, ?)", [$packageId, $projectId]);
    }
}