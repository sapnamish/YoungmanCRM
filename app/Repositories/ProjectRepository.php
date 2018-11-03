<?php namespace App\Repositories;

use DB;
use App\Project;

class ProjectRepository
{

    public function all()
    {
        return Project::with('user', 'pmc', 'client')->get();
    }

    public function store($input)
    {
        $project = new Project($input);
        $project->save();
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
    }

    public function update($input, $id)
    {

    }

    public function show($id)
    {
        return Project::find($id);
    }

    public function attachPMC($pmcId, $projectId)
    {
        $project = Project::find($projectId);
        $project->pmc_id = $pmcId;
        $project->save();
    }

    public function attachClient($clientId, $projectId)
    {
        $project = Project::find($projectId);
        $project->client_id = $clientId;
        $project->save();
    }

}