<?php
/**
 * Created by PhpStorm.
 * User: vikasmahato
 * Date: 03/11/18
 * Time: 9:37 AM
 */

namespace App\Repositories;


use App\Client;

class ClientRepository
{

    public function all()
    {
        //return Client::with('user', 'Client', 'client')->get();
        return Client::all();
    }

    public function store($input)
    {
        $client = new Client($input);
        $client->save();
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function search($term){
        return Client::where('name','LIKE','%'.$term.'%')->get();
    }

}