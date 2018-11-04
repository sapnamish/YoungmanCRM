<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packageService;

    public function __construct()
    {
        $this->packageService = new PackageService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = $this->packageService->all();
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'package_name'=>'required'
        ]);

        if($this->packageService->store($request))
            return redirect('/package')->with('success', 'Package has been added');
        else
            return redirect('/package')->with('error', 'Package could not be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = $this->packageService->show($id);
        return view('packages.show', compact('package'));
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

    public function attachContractor(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'contractor_id' => 'required',
            'contractor_name' => 'required'
        ]);

        $redirect_to = $request->redirect_to;
        if($redirect_to == null || $redirect_to == "")
            $redirect_to = "/package";

        if($this->packageService->attachContractor($request))
            return redirect($redirect_to)->with('success', 'Contractor has been attached');
        else
            return redirect($redirect_to)->with('error', 'Contractor could not be attached');
    }

    public function attachProject(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'project_id' => 'required',
            'project_name' => 'required'
        ]);

        $redirect_to = $request->redirect_to;
        if($redirect_to == null || $redirect_to == "")
            $redirect_to = "/package";

        if($this->packageService->attachProject($request))
            return redirect($redirect_to)->with('success', 'Project has been attached');
        else
            return redirect($redirect_to)->with('error', 'Project could not be attached');

    }
}
