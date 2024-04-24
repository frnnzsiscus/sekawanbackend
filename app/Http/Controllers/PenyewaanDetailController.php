<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PenyewaanDetailModel;

class PenyewaanDetailController extends Controller
{
    protected $PenyewaanDetailModel;

public function __construct()
{
    $this->PenyewaanDetailModel = new PenyewaanDetailModel();
}

public function index()
{
    $penyewaandetail = $this->PenyewaanDetailModel->get_penyewaan_detail();
    if (count($penyewaandetail) === 0) {
        return response()->json([], 204);
    } else {
        return response()->json([
            'status' => 200,
            'message' => 'Data penyewaan detail berhasil didapatkan!',
            'data' => $penyewaandetail
        ], 200);
    }
}

public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'penyewaan_detail_penyewaan_id' => 'required|numeric',
            'penyewaan_detail_alat' => 'required|numeric',
            'penyewaan_detail_jumlah' => 'required|numeric',
            'penyewaan_detail_subharga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data penyewaan detail gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaandetail = $this->PenyewaanDetailModel->create_penyewaan_detail($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data penyewaan detail berhasil dibuat!',
                'data' => $penyewaandetail
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
            'penyewaan_detail_penyewaan_id' => 'required|numeric',
            'penyewaan_detail_alat' => 'required|numeric',
            'penyewaan_detail_jumlah' => 'required|numeric',
            'penyewaan_detail_subharga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data penyewaan detail gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $penyewaandetail = $this->PenyewaanDetailModel->update_penyewaan_detail($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data penyewaan detail berhasil diupdate!',
                'data' => $penyewaandetail
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
    $penyewaandetail = $this->PenyewaanDetailModel->delete_penyewaan_detail($id);
    return response()->json([
        'status' => 200,
        'message' => 'Data penyewaan detail berhasil dihapus!',
        'data' => $penyewaandetail
    ], 200);
}

}
