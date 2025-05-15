<?php

namespace App\Http\Controllers;

use App\Models\Seragam;
use Illuminate\Http\JsonResponse;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeragamController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(): JsonResponse
    {
        $seragam = Seragam::with('karyawan')->get();
        if (!$seragam) {
            return response()->json(['success' => false, 'message' => 'Seragam tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $seragam]);
    }

    public function show($IdSeragam)
    {
        $seragam = Seragam::with('karyawan')->find($IdSeragam);
        if (!$seragam) {
            return response()->json(['success' => false, 'message' => 'Seragam tidak ditemukan'], 404);
        }
        return response()->json(['success' => true, 'data' => $seragam]);
    }


    public function store(Request $request): JsonResponse
    {
        // Validasi data yang diterima menggunakan Validator
        $validator = Validator::make($request->all(), [
            'IdKaryawan' => 'required|string|max:255',
            'Ukuran' => 'required|string|max:255',
            'TglTerima' => 'required|integer',
        ]);

        // Jika validasi gagal, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Membuat data baru
        $seragam = Seragam::create([
            'IdKaryawan' => $request->input('IdKaryawan'),
            'Ukuran' => $request->input('Ukuran'),
            'TglTerima' => $request->input('TglTerima'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Seragam created successfully',
            'data' => $seragam
        ]);
    }

    public function update(Request $request, $IdSeragam): JsonResponse
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'IdKaryawan' => 'required|string|max:255',
            'Ukuran' => 'required|string|max:255',
            'TglTerima' => 'required|integer',
        ]);

        // Cari data berdasarkan ID dan pastikan ada
        $seragam = Seragam::findOrFail($IdSeragam);

        // Update data
        $seragam->IdKaryawan = $request->input('IdKaryawan');
        $seragam->Ukuran = $request->input('Ukuran');
        $seragam->TglTerima = $request->input('TglTerima');
        $seragam->save();

        return response()->json([
            'success' => true,
            'message' => 'Seragam updated successfully',
            'data' => $seragam
        ]);
    }

    public function destroy($IdSeragam): JsonResponse
    {
        $seragam = Bagian::findOrFail($IdSeragam);
        $seragam->delete();

        return response()->json([
            'success' => true,
            'message' => 'Seragam deleted successfully'
        ]);
    }
}
