<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Http\Requests\UserRequest;

class UserController extends Controller{
    public function index(){
        $users = User::query()->latest()->get();
        return view('users.index', [
            "users" => $users
        ]);
    }

    public function create(){
        return view('users.form', [
            "user" => new User(),
            "page_meta" => [
                "title" => "Create New User",
                "description" => "Create New User",
                "method" => "POST",
                "url" => route('users.store'),
                "submit_text" => "Create"
            ]
        ]
    );
    }

    public function store(UserRequest $request){
        $validated = $request->validated();
        User::create($validated);
        return to_route('users.index');
    }

    public function show(User $user){
        return view('users.show', [
            "user" => $user
        ]);
    }

    public function edit(User $user){
        return view('users/form', [
            "user"=> $user,
            "page_meta" => [
                "title" => "Edit User : ". $user->name,
                "description" => "Edit User: ",
                "method" => "PUT",
                "url" => route('users.update', $user->id),
                "submit_text" => "Update"
            ]
        ]);
    }

    public function update(UserRequest $request, User $user){
        $user->update($request->validated());
    
        return to_route('users.index');
    }

    public function destroy(User $user){
        $user->delete();
        return to_route('users.index');
    }
}