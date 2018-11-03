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
        if($project->save()){
            return $project->id;
        }
        return null;
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

    public function updateStatus($projectId, $newStatus)
    {
        $project = Project::find($projectId);
        $project->status = $newStatus;
        $project->save();
    }

    public function logProjectStatus($projectId, $status, $comments)
    {
        DB::insert("INSERT INTO project_status_log ( project_id, status, comment, created_at, updated_at) 
                    VALUES (?, ?, ?, CURRENT_TIMESTAMP , CURRENT_TIMESTAMP ) ", [$projectId, $status, $comments]);
    }

}