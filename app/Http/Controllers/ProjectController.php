<?php

namespace App\Http\Controllers;

use App\Actions\Project\{CreateProject, DeleteProject, UpdateProject};
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\{ProjectCollection, ProjectResource};
use App\Models\Project;
use Illuminate\Http\Request;
use Throwable;

class ProjectController extends BaseController
{
    /**
     * Get the project list.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new ProjectCollection(
            Project::getList($request->all())
        );
    }

    /**
     * Store a new project.
     *
     * @param ProjectRequest  $request
     * @param CreateProject  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectRequest $request, CreateProject $action)
    {
        try {
            $project = $action->execute($request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on create project!');
        }

        return $this->responseCreated(
            'Project created successfully!',
            new ProjectResource($project)
        );
    }

    /**
     * Get the project.
     *
     * @param Project $project
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    /**
     * Update a project information.
     *
     * @param ProjectRequest  $request
     * @param Project $project
     * @param UpdateProject  $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectRequest $request, Project $project, UpdateProject $action)
    {
        try {
            $action->execute($project, $request);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on update project!');
        }

        return $this->responseOk(
            'Project updated successfully!',
            new ProjectResource($project)
        );
    }

    /**
     * Delete a project.
     *
     * @param Project $project
     * @param DeleteProject $action
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project, DeleteProject $action)
    {
        try {
            $action->execute($project);
        } catch (Throwable $exception) {
            throw_if(is_development(), $exception);

            return $this->responseError('Error on delete project!');
        }

        return $this->responseOk('Project deleted successfully!');
    }
}
