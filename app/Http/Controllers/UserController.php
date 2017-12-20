<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->user = $user;
    }

    public function register(Request $request){
        $user = $this->user->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'Usuário criado com sucesso',
            'data'=>$user
        ]);
    }

    public function getUsers(Request $request){
        $users = User::all();
        return response()->json(['result' => $users]);
    }

}
