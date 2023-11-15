<?php

namespace App\Http\Controllers;

use App\Models\Almaceneros;
use App\Models\Choferes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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
    public function Login(Request $request)
    {
        if (Auth::attempt(['name' => $request->post('name'), 'password' => $request->post('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('authToken')->accessToken;
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $aplicacion = $this->respuestaAplicacion($request,$user);
            if ($aplicacion == true) {
                $response = response($success);
                return $response;
            }
        }

        return Response(["message" => "Not authorized",], 401);
    }

    public function respuestaAplicacion(Request $request,$user)
    {
        $datoAplicaicon = $request->post("aplicacion");
        if ($datoAplicaicon == "choferes") {
            $chofer=Choferes::where('id_usuarios',$user->id)->first();
            if($chofer)
            return true;
        }
        if($datoAplicaicon=='almacen'){
            $almacen=Almaceneros::where('id_usuarios',$user->id)->first();
            if($almacen)
            return true;
        }
        return false;
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