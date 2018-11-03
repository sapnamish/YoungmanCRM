<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 03/11/18
 * Time: 9:37 AM
 */

namespace App\Services;
use Illuminate\Http\Request;


use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct()
    {
        $this->clientRepository = new ClientRepository();
    }

    public function all()
    {
        return $this->clientRepository->all();
    }

    public function store(Request $request)
    {



        $input = $request->all();
        $this->clientRepository->store($input);
    }

    public function destroy($id)
    {
        $this->clientRepository->destroy($id);
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return $this->clientRepository->show($id);
    }

    public function search($term)
    {
        $clients = $this->clientRepository->search($term);
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