<?php

namespace App\Actions\Project;

use App\Models\Project;

class DeleteProject
{
    /**
     * Delete a project
     *
     * @param Project $project
     *
     * @return bool
     */
    public function execute(Project $project): bool
    {
        return $project->delete();
    }
}
