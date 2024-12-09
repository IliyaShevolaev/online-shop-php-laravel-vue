<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\EditUserDataRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return new UserResource(Auth::user());
    }

    public function edit(EditUserDataRequest $editUserDataRequest) 
    {
        $data = $editUserDataRequest->validated();

        $user = Auth::user();
        $user->update($data);
    }
}
