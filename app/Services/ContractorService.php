<?php
/**
 * Created by PhpStorm.
 * User: sapnamishra
 * Date: 24/10/18
 * Time: 10:41 PM
 */

namespace App\Services;


use App\Repositories\ContractorRepository;
use Illuminate\Http\Request;
use DB;

class ContractorService
{
    protected $contractorRepository;

    public function __construct()
    {
        $this->contractorRepository = new ContractorRepository();
    }

    public function all()
    {
        return $this->contractorRepository->all();
    }

    public function store(Request $request)
    {
        $input = array(
            'name' => $request->name,
            'email' => $request->email,
            'state_code' => $request->state_code,
            'city' => $request->city,
            'phone_number' => $request->phone_number
        );

        return $this->contractorRepository->store($input);
    }

    public function destroy($id)
    {
        $this->contractorRepository->destroy($id);
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return $this->contractorRepository->show($id);
    }

    public function search($term)
    {
        $clients = $this->contractorRepository->search($term);
        $data=array();
        foreach ($clients as $client) {
            $data[]=array(
                'value'=>$client->name,
                'id'=>$client->id,
            );
        }
        return $data;
    }
}