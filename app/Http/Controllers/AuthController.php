<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'=> 'required',
            'email'=> 'required|unique:user,email',
            'password'=> 'required|confirmed',

        ]);

        $user = User::create([
            'name'=> $fields ['name'],
            'email'=> $fields ['email'],
            'password'=> bcrypt($fields ['name']),
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->currentAccessToken()->delete();

        return [
            'message' => 'Log out'
        ];
    }

    public function login(Request $request){

        $fields = $request->validate([
            'email'=> 'required',
            'password'=> 'required|confirmed',

        ]);

        //Провека email

        $user = User::where('mail', $fields['email'] ->first() );

        //Проверка password

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'message' => 'Log in',
                'token' => $token,
            ];
            return response($response, 200);  
        }else {

        }

        // if (!user || !Hash::check($fields['password'], $user->password)) {
        //     return response ([
        //         'message' => 'No autorization'
        //     ], 401);
        // }
        //return response($response, 201);
    }
    
}
