<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Bagian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        // Validasi data yang diterima menggunakan Validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Jika validasi gagal, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Membuat data baru
        $bagian = Bagian::create([
            'NamaBagian' => $request->input('NamaBagian'),
            'Yonma' => $request->input('Yonma'),
            'UrutanBagian' => $request->input('UrutanBagian'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bagian created successfully',
            'data' => $bagian
        ]);
    }

    public function update(Request $request, $IdBagian): JsonResponse
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'NamaBagian' => 'required|string|max:255',
            'Yonma' => 'required|string|max:255',
            'UrutanBagian' => 'required|integer',
        ]);

        // Cari data berdasarkan ID dan pastikan ada
        $bagian = Bagian::findOrFail($IdBagian);

        // Update data
        $bagian->NamaBagian = $request->input('NamaBagian');
        $bagian->Yonma = $request->input('Yonma');
        $bagian->UrutanBagian = $request->input('UrutanBagian');
        $bagian->save();

        return response()->json([
            'success' => true,
            'message' => 'Bagian updated successfully',
            'data' => $bagian
        ]);
    }

    public function destroy($IdBagian): JsonResponse
    {
        $bagian = Bagian::findOrFail($IdBagian);
        $bagian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bagian deleted successfully'
        ]);
    }
}
