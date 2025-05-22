<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        //
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Username' => 'required|string',
            'Password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Input tidak valid',
                'errors' => $validator->errors(),
            ]);
        }

        $username = $request->input("Username");
        $password = $request->input("Password");
        $user = User::where('Username', $username)->first();

        if (!$user) {
            return response()->json([
                "status" => "error",
                "message" => "User tidak ditemukan"
            ]);
        }

        if (md5($password) === $user->Password) { 
            return response()->json([
                "status" => "success",
                "message" => "Berhasil login",
                "data" => [
                    "username" => $user->Username,
                ]
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => "Password salah"
            ]);
        }
    }

    public function register()
    {

    }
}
