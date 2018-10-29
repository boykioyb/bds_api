<?php

namespace App\Http\Controllers\v1\cms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    private $session;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create a new token.
     *
     * @param  \App\User $user
     * @return string
     */
    protected function jwt(User $user)
    {
        $payload = [
            'iss' => "hoatq@123", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60 * 60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function authenticate(User $user)
    {
        $validator = Validator::make($this->request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|min:6',

        ], [
            'username.required' => 'Please enter a username',
            'password.required' => 'Please enter a password',
        ]);
        if ($validator->fails()) {
            $this->responseData['data']['content'] = $validator->errors();
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = 400;
            $this->responseData['message'] = "validator fails";
            return response()->json($this->responseData);
        }
        $username = $this->formatDataInput($this->request->input('username'));
        $password = $this->formatDataInput($this->request->input('password'));
        // Find the user by email
        $user = User::where('username', $this->request->input('username'))->first();

        if (!$user) {
            $this->responseData['success'] = false;
            $this->responseData['errorCode'] = 400;
            $this->responseData['message'] = "Email does not exist.";
            return response()->json($this->responseData);
        }

        // Verify the password and generate the token
        if (Hash::check($username . $password, $user->password)) {

            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        $this->responseData['success'] = false;
        $this->responseData['errorCode'] = 400;
        $this->responseData['message'] = "Email or password is wrong.";
        return response()->json($this->responseData);
        // Bad Request response
    }
}