<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Arr;

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
                "url" => "/users",
                "submit_text" => "Create"
            ]
        ]
    );
    }

    public function store(Request $request){
        $validated = $request->validate($this->requestValidated());
        User::create($validated);
        return redirect('/users');
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
                "url" => "/users/{$user->id}",
                "submit_text" => "Update"
            ]
        ]);
    }

    public function update(Request $request, User $user){
        $user->update($request->validate($this->requestValidated()));
    
        return redirect('/users');
    }

    protected function requestValidated() : Array
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ];
    }
}