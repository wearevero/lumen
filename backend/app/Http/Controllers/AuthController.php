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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'Username' => 'required|string',
            'Password' => 'required|string',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Input tidak valid',
                'errors' => $validator->errors(),
            ]);
        }

        // Ambil data input
        $username = $request->input("Username");
        $password = $request->input("Password");

        // Query untuk mencari user berdasarkan Username dengan memperhatikan kapitalisasi
        $user = User::where('Username', $username)->first();  // Pastikan 'Username' sesuai dengan kolom di database

        if (!$user) {
            return response()->json([
                "status" => "error",
                "message" => "User tidak ditemukan"
            ]);
        }

        // Verifikasi password menggunakan MD5 (jika password disimpan dalam MD5 di database)
        if (md5($password) === $user->Password) {  // Pastikan 'Password' sesuai dengan kolom di database
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
}
