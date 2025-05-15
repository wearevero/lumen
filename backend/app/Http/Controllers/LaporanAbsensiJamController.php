<?php

namespace App\Http\Controllers;

use App\Models\AbsenHarianJam;
use App\Models\Bagian;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class LaporanAbsensiJamController extends Controller
{
    protected AbsenHarianJam $absenModel;
    protected Bagian $bagianModel;

    public function __construct(AbsenHarianJam $absenModel, Bagian $bagianModel)
    {
        $this->absenModel = $absenModel;
        $this->bagianModel = $bagianModel;
    }

    public function index(): JsonResponse
    {
        $absen = $this->absenModel->all();

        return response()->json([
            'success' => true,
            'data' => $absen
        ]);
    }

    public function show($IdBagian, $TglMasuk): JsonResponse
    {
        if (!Carbon::hasFormat($TglMasuk, 'Y-m-d')) {
            return response()->json([
                'success' => false,
                'message' => 'Format tanggal tidak valid. Gunakan format YYYY-MM-DD.',
            ], 400);
        }

        if ($IdBagian === 'all') {
            $absensi = $this->absenModel->with('karyawan')
                ->whereDate('TglAbsen', $TglMasuk)
                ->get();

            return response()->json([
                'success' => true,
                'bagian' => 'all',
                'total_absensi' => $absensi->count(),
                'absensi' => $absensi,
            ]);
        }

        $bagian = $this->bagianModel->findOrFail($IdBagian);

        $absensi = $this->absenModel
            ->where('IdBagian', $IdBagian)
            ->whereDate('TglAbsen', $TglMasuk)
            ->get();

        return response()->json([
            'success' => true,
            'bagian' => $bagian,
            'total_absensi' => $absensi->count(),
            'absensi' => $absensi,
        ]);
    }
}
