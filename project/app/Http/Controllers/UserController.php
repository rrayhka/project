<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller{
    public function index(){
        $users = User::query()->latest()->get();
        return view('users.index', [
            "users" => $users
        ]);
    }

    public function create(){
        return view('users.create');
    }
}