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

        // $query = Karyawan::where('Aktif', 'Ya')->with('bagian');
        $karyawan = Karyawan::all();
        $jumlah = $karyawan->count();

        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where(function ($q) use ($search) {
        //         $q->where('NamaLengkap', 'like', '%' . $search . '%')
        //             ->orWhere('NikKaryawan', 'like', '%' . $search . '%')
        //             ->orWhere('Jabatan', 'like', '%' . $search . '%');
        //     });
        // }

        // $karyawan = $query->paginate(10);

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
