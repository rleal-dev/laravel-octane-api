<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;

class ProfileController extends BaseController
{
    /**
     * Get the user profile
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return new ProfileResource($this->user());
    }
}
