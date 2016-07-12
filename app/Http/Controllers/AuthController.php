<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * AuthController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Login user by given credentials
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required|min:4'
        ]);

        return $this->validateByCredentials($this->getCredentials($request));
    }

    /**
     * Create new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'fullname' => 'required',
            'password' => 'required|min:4'
        ]);

        return $this->createNewUser($request->all());

    }

    /**
     * Get the needed authorization credentials from the request.
     * @param Request $request
     * @return array
     */
    private function getCredentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    /**
     * Validate login request against given credentails
     *
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function validateByCredentials($credentials)
    {
        $user = User::where('username', $credentials['username'])->first();

        if ($user && app('hash')->check($credentials['password'], $user->password)) {
            return response()->json([
                'api_token' => $user->api_token
            ]);
        }

        return response()->json([
            'message' => 'Credentials did not match'
        ],401);
    }

    /**
     * Add new record in users table
     * 
     * @param $arrData
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    private function createNewUser($arrData)
    {
        $user = $this->user->create($arrData);
        $user->setApiToken();

        if(is_object($user) && $user->exists)
        {
            return response()->json([
                'api_token' => $user->api_token
            ]);
        }

        return response()->json([
            'message' => 'Something went wrong'
        ],422);
    }
}