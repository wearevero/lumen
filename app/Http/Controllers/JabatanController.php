<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(): JsonResponse
    {
        $jabatan = Jabatan::all();
        return response()->json([
            'success' => true,
            'data' => $jabatan
        ]);
    }

    public function show($IdJabatan): JsonResponse
    {
        $jabatan = Jabatan::findOrFail($IdJabatan);  // Menggunakan findOrFail untuk memastikan data ada
        return response()->json([
            'success' => true,
            'data' => $jabatan
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        // Validasi data yang diterima menggunakan Validator
        $validator = Validator::make($request->all(), [
            'Jabatan' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Membuat data baru
        $bagian = Jabatan::create([
            'Jabatan' => $request->input('Jabatan'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jabatan created successfully',
            'data' => $bagian
        ]);
    }

    public function update(Request $request, $IdJabatan): JsonResponse
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'Jabatan' => 'required|string|max:255',
        ]);

        // Cari data berdasarkan ID dan pastikan ada
        $jabatan = Jabatan::findOrFail($IdJabatan);

        // Update data
        $jabatan->Jabatan = $request->input('Jabatan');
        $jabatan->Yonma = $request->input('Yonma');
        $jabatan->UrutanBagian = $request->input('UrutanBagian');
        $jabatan->save();

        return response()->json([
            'success' => true,
            'message' => 'Jabatan updated successfully',
            'data' => $jabatan
        ]);
    }

    public function destroy($IdJabatan): JsonResponse
    {
        $jabatan = Jabatan::findOrFail($IdJabatan);
        $jabatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jabatan deleted successfully'
        ]);
    }
}
