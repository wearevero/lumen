<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index(Request $request): JsonResponse
    {

        $karyawan = Karyawan::where('Aktif', 'Ya')->with('bagian')->paginate(10);

        $jumlah = $karyawan->count();

        return response()->json([
            'status' => 200,
            'success' => true,
            'jumlah' => $jumlah,
            'data' => $karyawan,
        ]);
    }

    public function show($IdKaryawan): JsonResponse
    {
        $karyawan = Karyawan::findOrFail($IdKaryawan);
        return response()->json([
            'success' => true,
            'data' => $karyawan
        ]);
    }
}
