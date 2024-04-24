<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PenyewaanModel;

class PenyewaanController extends Controller
{
    protected $PenyewaanModel;

    public function __construct()
    {
        $this->PenyewaanModel = new PenyewaanModel();
    }

    public function index()
    {
        $penyewaan = $this->PenyewaanModel->get_penyewaan();
        if (count($penyewaan) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data penyewaan berhasil didapatkan!',
                'data' => $penyewaan
            ], 200);
        }
    }

    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'penyewaan_pelanggan_id' => 'required|numeric',
            'penyewaan_tglsewa' => 'required|date',
            'penyewaan_tglkembali' => 'required|date',
            'penyewaan_sttspembayaran' => 'required|in:Lunas,Belum Dibayar,DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Kembali',
            'penyewaan_totalharga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data penyewaan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaan = $this->PenyewaanModel->create_penyewaan($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data penyewaan berhasil dibuat!',
                'data' => $penyewaan
            ], 201);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Terjadi kesalahan pada server.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function update(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'penyewaan_pelanggan_id' => 'required|numeric',
            'penyewaan_tglsewa' => 'required|date',
            'penyewaan_tglkembali' => 'required|date',
            'penyewaan_sttspembayaran' => 'required|in:Lunas,Belum Dibayar,DP',
            'penyewaan_sttskembali' => 'required|in:Sudah Kembali,Belum Kembali',
            'penyewaan_totalharga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data penyewaan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaan = $this->PenyewaanModel->update_penyewaan($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data penyewaan berhasil diupdate!',
                'data' => $penyewaan
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Terjadi kesalahan pada server.',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function destroy($id)
    {
        $penyewaan = $this->PenyewaanModel->delete_penyewaan($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data pelanggan data berhasil dihapus!',
            'data' => $penyewaan
        ], 200);
    }
}
