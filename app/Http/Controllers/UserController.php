<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;



class UserController extends Controller
{
    public function Registrar(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if ($validation->fails())
            return $validation->errors();

        return $this->crearUsuario($request);
    }

    public function Login(Request $request){
        if(Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('authToken')-> accessToken; 
            $success['name'] =  $user->name;
   
            $response = response($success);

            return $response->cookie('token', $success['token'], 500); // Set the token as a cookie
        } 
    }

    private function crearUsuario($request)
    {
        $user = new User();
        $user->name = $request->post("name");
        $user->email = $request->post("email");
        $user->password = Hash::make($request->post("password"));
        $user->save();
        return $user;
    }

    public function ValidarToken(Request $request)
    {
        return auth('api')->user();
    }

    public function Logout(Request $request)
    {
        $request->user()->token()->revoke();
        return ['message' => 'Token Revoked'];
    }
}
