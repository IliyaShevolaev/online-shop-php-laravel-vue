<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $userRequest)
    {
        $data = $userRequest->validated();
        $data['password'] = User::getDefaultPassword();

        User::create($data);

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $userRequest, User $user)
    {
        $data = $userRequest->validated();
        $user->update($data);

        return view('admin.user.show', compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
