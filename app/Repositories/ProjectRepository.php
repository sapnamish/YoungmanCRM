<?php namespace App\Repositories;

use DB;
use App\Project;

class ProjectRepository
{

    public function all()
    {
        return Project::all();
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

}