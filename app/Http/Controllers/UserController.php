<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

/**
 * Class User
 *
 * @package App
 *
 * @SWG\Swagger(
 *     basePath="",
 *     host="localhost:8000",
 *     schemes={"http"},
 *     @SWG\Info(
 *          description= "API do teste proposto pela Vende+ Club",
 *          version= "1.0.0",
 *          title= "Teste Vende+ API",
 *         @SWG\Contact(name="Ronaldo Moraes", email="ronaldo.moraes1990@gmail.com"),
 *     ),
 *     @SWG\Definition(
 *     definition="User",
 *     required={"id", "name", "email", "password"},
 *        @SWG\Property(
 *            property="id",
 *            type="integer",
 *        ),
 *        @SWG\Property(
 *            property="name",
 *            type="string"
 *        ),
 *        @SWG\Property(
 *            property="email",
 *            type="string",
 *        ),
 *        @SWG\Property(
 *            property="password",
 *            type="string",
 *        ),
 *        @SWG\Property(
 *            property="created_at",
 *            type="timestamp",
 *        ),
 *        @SWG\Property(
 *            property="updated_at",
 *            type="timestamp",
 *        ),
 *        @SWG\Property(
 *            property="deleted_at",
 *            type="timestamp",
 *        )
 *     )
 * )
 */

class UserController extends Controller
{
    private $user;
    public function __construct(User $user){
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->user = $user;
    }


    /**
     * Creates a new user in the system.
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     *  @SWG\Post(
     *     path="/api/auth/register",
     *     description="Create a new User to the system.",
     *     operationId="registerUser",
     *     produces={"application/json"},
     *     tags={"unlogged"},
     *     @SWG\Parameter(
     *          name="name",
     *           in="query",
     *           description="The name of the new User to be created",
     *           required=true,
     *           type="string"
     *     ),
     *     @SWG\Parameter(
     *          name="email",
     *           in="query",
     *           description="The email of the new User to be created",
     *           required=true,
     *           type="string"
     *      ),
     *     @SWG\Parameter(
     *          name="password",
     *           in="query",
     *           description="The password of the new User to be created",
     *           required=true,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="User was successfully created."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action",
     *     ),
     *     @SWG\Response(
     *         response=409,
     *         description="An existing item already exists.",
     *     )
     * )
     * 
     */

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

/**
     * Get all active users of the system
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     *  @SWG\Get(
     *     path="/api/users",
     *     description="Get all active Users of the system.",
     *     operationId="getUsers",
     *     produces={"application/json"},
     *     tags={"logged"},
     *     @SWG\Parameter(
     *          name="token",
     *           in="query",
     *           description="authentication token",
     *           required=true,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Users being listed."
     *     ),
     * @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid input, object invalid.",
     *     )
     * )
     * 
     */

    public function getUsers(){
        $users = User::all();
        return response()->json(['data' => $users]);
    }

/**
     * Update an user
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     *  @SWG\Put(
     *     path="/api/users/{userId}",
     *     description="Update an User by a given ID.",
     *     operationId="updateUser",
     *     produces={"application/json"},
     *     tags={"logged"},
     *     @SWG\Parameter(
     *          name="userId",
     *           in="path",
     *           description="Numeric ID of the user to get.",
     *           required=true,
     *           type="integer"
     *     ),@SWG\Parameter(
     *          name="token",
     *           in="query",
     *           description="authentication token",
     *           required=true,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="name",
     *           in="query",
     *           description="New name of the user",
     *           required=false,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="email",
     *           in="query",
     *           description="New email of the user",
     *           required=false,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="password",
     *           in="query",
     *           description="New password of the user",
     *           required=false,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User data updated."
     *     ),
     * @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="User not found.",
     *     )
     * )
     * 
     */

/**
     * Update an user
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     *  @SWG\Patch(
     *     path="/api/users/{userId}",
     *     description="Update an User by a given ID.",
     *     operationId="update2User",
     *     produces={"application/json"},
     *     tags={"logged"},
     *     @SWG\Parameter(
     *          name="userId",
     *           in="path",
     *           description="Numeric ID of the user to get.",
     *           required=true,
     *           type="integer"
     *     ),@SWG\Parameter(
     *          name="token",
     *           in="query",
     *           description="authentication token",
     *           required=true,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="name",
     *           in="query",
     *           description="New name of the user",
     *           required=false,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="email",
     *           in="query",
     *           description="New email of the user",
     *           required=false,
     *           type="string"
     *     ),@SWG\Parameter(
     *          name="password",
     *           in="query",
     *           description="New password of the user",
     *           required=false,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User data updated."
     *     ),
     * @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="User not found.",
     *     )
     * )
     * 
     */

    public function update(User $user, Request $request){

        if (empty($user)) {
            return response()->json(['data' => $user, 'message' => 'User not found']);
        }

        if ($request->get('name')!=''){
            $user->name = $request->get('name');
        }
        if ($request->get('email')!=''){
            $user->email = $request->get('email');
        }
        if ($request->get('password')!=''){
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

        return response()->json(['data' => $user]);
    }

    /**
     * Delete an user
     *
     * @return \Illuminate\Http\JsonResponse
     * 
     *  @SWG\Delete(
     *     path="/api/users/{userId}",
     *     description="Delete an User by a given ID.",
     *     operationId="deleteUser",
     *     produces={"application/json"},
     *     tags={"logged"},
     *     @SWG\Parameter(
     *          name="userId",
     *           in="path",
     *           description="Numeric ID of the user to be deleted.",
     *           required=true,
     *           type="integer"
     *     ),@SWG\Parameter(
     *          name="token",
     *           in="query",
     *           description="authentication token",
     *           required=true,
     *           type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="User safely deleted."
     *     ),
     * @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="User not found.",
     *     )
     * )
     * 
     */

    public function delete(User $user){
        if (empty($user)) {
            return response()->json(['data' => $user, 'message' => 'User not found']);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

}
