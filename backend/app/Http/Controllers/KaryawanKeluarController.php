<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\KaryawanKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanKeluarController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(): JsonResponse
    {
        $karyawankeluar = KaryawanKeluar::with('karyawan')->get();
        return response()->json([
            'success' => true,
            'data' => $karyawankeluar
        ]);
    }

    public function show($IdKeluar): JsonResponse
    {
        $karyawankeluar = KaryawanKeluar::with('karyawan')->find($IdKeluar);

        if (!$karyawankeluar) {
            return response()->json([
                'success' => false,
                'message' => 'Data Karyawan Keluar dengan ID ' . $IdKeluar . ' tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $karyawankeluar
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        // Validasi data yang diterima menggunakan Validator
        $validator = Validator::make($request->all(), [
            'IdKarayawan' => 'required|string|max:255',
            'TglPengajuan' => 'required|string|max:255',
            'TglKeluar' => 'required|integer',
            'Alasan' => 'required|string|max:255',
            'DapatSeragam' => 'required|string|max:255',
            'KembaliSeragam' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, return error response
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Membuat data baru
        $karyawankeluar = KaryawanKeluar::create([
            'IdKaryawan' => $request->input('IdKaryawan'),
            'TglPengajuan' => $request->input('TglPengajuan'),
            'TglKeluar' => $request->input('TglKeluar'),
            'Alasan' => $request->input('Alasan'),
            'DapatSeragam' => $request->input('DapatSeragam'),
            'KembaliSeragam' => $request->input('KembaliSeragam'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Karyawan Keluar created successfully',
            'data' => $karyawankeluar
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
        $bagian = KaryawanKeluar::findOrFail($IdBagian);

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
        $bagian = KaryawanKeluar::findOrFail($IdBagian);
        $bagian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bagian deleted successfully'
        ]);
    }
}
