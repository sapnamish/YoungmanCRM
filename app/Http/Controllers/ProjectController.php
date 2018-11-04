<?php

namespace App\Http\Controllers;

use App\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct()
    {
        $this->projectService = new ProjectService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = $this->projectService->all();

        return view('projects.index', compact('projects'));
    }

    public function allJson()
    {
        return $this->projectService->all()->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'address'=> 'required',
            'completion_date' => 'required'
        ]);

        if($this->projectService->store($request))
            return redirect('/project')->with('success', 'Project has been added');
        else
            return redirect('/project')->with('error', 'Project could not be saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = $this->projectService->show($id);dd($project);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->projectService->show($id);
        return view('projects.edit', compact('project'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->projectService->destroy($id);

        return redirect('/project')->with('success', 'Project has been deleted Successfully');
    }

    public function attachPMC(Request $request)
    {
        $request->validate([
            'project_id'=>'required',
            'pmc_id'=> 'required',
            'pmc_name' => 'required',
        ]);

        $redirect_to = $request->redirect_to;
        if($redirect_to == null || $redirect_to == "")
            $redirect_to = "/project";

        if($this->projectService->attachPMC($request))
            return redirect($redirect_to)->with('success', 'PMC has been attached');
        else
            return redirect($redirect_to)->with('error', 'PMC could not be attached');
    }

    public function attachClient(Request $request)
    {
        $request->validate([
            'project_id'=>'required',
            'client_id'=> 'required',
            'client_name' => 'required',
        ]);

        $redirect_to = $request->redirect_to;
        if($redirect_to == null || $redirect_to == "")
            $redirect_to = "/project";

        if($this->projectService->attachClient($request))
            return redirect($redirect_to)->with('success', 'Client has been attached');
        else
            return redirect($redirect_to)->with('error', 'Client could not be attached');
    }

    public function updateStatus(Request $request)
    {
        $type = $request->type;
        $type = strtoupper($type);

        $isUpdated = false;

        $isUpdated = $this->projectService->updateStatus($request);

        if($isUpdated){
            return redirect("/project")->with('success', 'Updated successfully');
        }
        else{
            return redirect("/project")->with('error', 'Could not update');
        }
    }

    public function search(Request $request){
        $query = $request->get('term','');
        $data = $this->projectService->search($query);
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

}
