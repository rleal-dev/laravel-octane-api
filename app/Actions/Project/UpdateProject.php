<?php

namespace App\Actions\Project;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class UpdateProject
{
    /**
     * Update a project
     *
     * @param Project $project
     * @param ProjectRequest $request
     *
     * @return bool
     */
    public function execute(Project $project, ProjectRequest $request): bool
    {
        return $project->update($request->validated());
    }
}
