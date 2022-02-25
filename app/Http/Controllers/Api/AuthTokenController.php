<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AuthTokenRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;

class AuthTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthTokenRequest $request)
    {
        if (auth('sanctum')->check()) {
            return response()->json([
                'message'   => 'Hello '. explode(' ', auth('sanctum')->user()->name)[0] . ', you are already logged in',
                'flash'     => 'info', 
            ], 302);
        }
        else {
            $user = User::where('email', $request->email)->first();

            if ( !$user ) {
                return [
                    'errors' => [
                        'email' => ['The provided credentials are incorrect.'],
                    ]
                ];
            }

            elseif (!Hash::check($request->password, $user->password)) {
                return [
                    'errors' => [
                        'password' => ['The password provided is incorrect.']
                    ]
                ];
            }

            return [ 'user' => new UserResource($user), 'token' => $user->createToken($request->device_name)->plainTextToken];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $request->user()->tokens()->delete();
    }
}
