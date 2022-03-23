<?php

namespace App\Actions\Project;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class CreateProject
{
    /**
     * Create a project
     *
     * @param ProjectRequest $request
     *
     * @return Project
     */
    public function execute(ProjectRequest $request): Project
    {
        return $request->user()->projects()->create($request->validated());
    }
}
