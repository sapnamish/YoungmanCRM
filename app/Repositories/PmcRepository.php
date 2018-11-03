<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 03/11/18
 * Time: 9:37 AM
 */

namespace App\Repositories;


use App\Pmc;

class PmcRepository
{

    public function all()
    {
        //return Pmc::with('user', 'pmc', 'client')->get();
        return Pmc::all();
    }

    public function store($input)
    {
        $pmc = new Pmc($input);
        $pmc->save();
    }

    public function destroy($id)
    {
        $pmc = Pmc::find($id);
        $pmc->delete();
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return Pmc::find($id);
    }

    public function search($term){
        return Pmc::where('name','LIKE','%'.$term.'%')->get();
    }

}