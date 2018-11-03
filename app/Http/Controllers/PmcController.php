<?php

namespace App\Http\Controllers;

use App\Services\PmcService;
use Illuminate\Http\Request;

class PmcController extends Controller
{

    protected $pmcService;

    public function __construct()
    {
        $this->pmcService = new PmcService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pmc.create_or_update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=> 'required',
            'phone_number' =>'required'
        ]);

        $redirect_to = $request->redirect_to;
        if($redirect_to == null || $redirect_to == "")
            $redirect_to = "/pmc";

        if($this->pmcService->store($request))
            return redirect($redirect_to)->with('success', 'PMC has been added');
        else
            return redirect($redirect_to)->with('error', 'PMC could not be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        $query = $request->get('term','');
        $data = $this->pmcService->search($query);
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
}
