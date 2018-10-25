<?php

namespace App\Http\Controllers;

use App\Services\ContractorService;
use Illuminate\Http\Request;

class ContractorController extends Controller
{

    protected $contractorService;

    public function __construct()
    {
        $this->contractorService = new ContractorService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractors = $this->contractorService->all();

        return view('contractors.index', compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contractors.create');
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
            'state_code' => 'required',
            'city' => 'required',
            'phone_number' =>'required'
        ]);

        if($this->contractorService->store($request))
            return redirect('/contractor')->with('success', 'Contractor has been added');
        else
            return redirect('/contractor')->with('error', 'Contractor could not be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contractor = $this->contractorService->show($id);dd($project);
        return view('contractors.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contractor = $this->contractorService->show($id);
        return view('contractors.edit', compact('project'));
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
        $this->contractorService->destroy($id);

        return redirect('/contractor')->with('success', 'Contractor has been deleted Successfully');
    }
}
