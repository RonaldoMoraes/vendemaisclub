<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */

class AuthController extends Controller
{
    
    
    public function __construct(User $user){
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Log the User in the system.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/api/auth/login",
     *     description="Log the User in the system.",
     *     operationId="loginUser",
     *     produces={"application/json"},
     *     tags={"unlogged"},
     *     @SWG\Parameter(
     *          name="email",
     *           in="query",
     *           description="The email of the User to be logged in",
     *           required=true,
     *           type="string"
     *      ),
     *     @SWG\Parameter(
     *          name="password",
     *           in="query",
     *           description="The password of the User to be logged in",
     *           required=true,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User logged in with success."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }


    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    public function guard(){
        return Auth::guard();
    }

}
