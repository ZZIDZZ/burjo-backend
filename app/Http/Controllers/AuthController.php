<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\CoreException;
use App\Models\Pengguna;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('setguard:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $pengguna = Pengguna::select("pengguna.*", "roles.role", "roles.description as role_description")->leftjoin('roles', 'roles.id', 'pengguna.idrole')->where("username", $credentials["username"])->first();

        if (empty($pengguna))
            return response()->json(["message" => __("message.userNotFound", ['username' => $credentials["username"]])], 422);
        
        //empty password
        $pengguna->password = "";

        
        

        
        if ($token = auth('api')->attempt($credentials)) {
        } else {
            // return error with 401
            return response()->json(["message" => __("message.loginCredentialFalse")], 401);
        }

        // if mahasiswa, check if already pkl or skripsi
        
        return [
            "pengguna" => $pengguna->toArray(),
            "token" => $token,
            "message" => __("message.loginSuccess")
        ];
    }

    public function register(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "email" => "required|email|unique:users",
            "name" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()], 422);
        }

        $input = $request->only('email', 'name', 'password');
        $pengguna = new Pengguna();
        $pengguna->email = $input["email"];
        $pengguna->name = $input["name"];
        $pengguna->password = bcrypt($input["password"]);
        $pengguna->save();

        if ($token = Auth::attempt($input)) {
            return $this->respondWithToken($token);
        }
    }

    /**
     * Get the authenticated Pengguna
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $id = auth('api')->user()->id;
        $pengguna = Pengguna::select("pengguna.*", "roles.role", "roles.description as role_description")->leftjoin('roles', 'roles.id', 'pengguna.idrole')->where("pengguna.id", $id)->first();
        if (empty($pengguna))
            return response()->json(["message" => __("message.userNotFound", ['id' => $id])], 422);
        
        // empty password
        $pengguna->password = "";

        return response()->json([
            "data" => $pengguna->toArray()
        ]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // check if already logged in first
        if (!$this->guard()->check()) {
            return response()->json(["message" => __("message.notLoggedIn")], 401);
        }
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard("api");
    }
}
