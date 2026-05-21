<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('backend.users.index', [
            //'users' => User::all(),
            'users' => $users,
            'totalUsers' => $users->count()
        ]);
    }

    public function create()
    {
        return view('backend.users.create');
    }

    public function store(Request $request)
    {
        User::create($request->all());

        return redirect('/users');
    }

    public function edit(User $user)
    {
        return view('backend.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect('/users');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect('/users');
    }
}