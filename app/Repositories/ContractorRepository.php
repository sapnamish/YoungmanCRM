<?php
/**
 * Created by PhpStorm.
 * User: sapnamishra
 * Date: 24/10/18
 * Time: 10:41 PM
 */

namespace App\Repositories;

use DB;
use App\Contractor;

class ContractorRepository
{
    public function all()
    {
        return Contractor::all();
    }

    public function store($input)
    {
        $contractor = new Contractor($input);
        $contractor->save();
        return true;
    }

    public function destroy($id)
    {
        $contractor = Contractor::find($id);
        $contractor->delete();
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return Contractor::find($id);
    }
}