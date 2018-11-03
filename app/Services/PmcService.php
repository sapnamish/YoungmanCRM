<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 03/11/18
 * Time: 9:37 AM
 */

namespace App\Services;
use Illuminate\Http\Request;


use App\Repositories\PmcRepository;

class PmcService
{
    protected $pmcRepository;

    public function __construct()
    {
        $this->pmcRepository = new PmcRepository();
    }

    public function all()
    {
        return $this->pmcRepository->all();
    }

    public function store(Request $request)
    {



        $input = $request->all();
        $this->pmcRepository->store($input);
    }

    public function destroy($id)
    {
        $this->pmcRepository->destroy($id);
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return $this->pmcRepository->show($id);
    }

    public function search($term)
    {
        $pmcs = $this->pmcRepository->search($term);
        $data=array();
        foreach ($pmcs as $pmc) {
            $data[]=array(
                'value'=>$pmc->name,
                'id'=>$pmc->id,
            );
        }
        return $data;
    }

}