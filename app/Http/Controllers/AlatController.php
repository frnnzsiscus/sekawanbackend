<?php

namespace App\Http\Controllers;

use App\Models\AlatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlatController extends Controller
{
    protected $AlatModel;

    public function __construct()
    {
        $this->AlatModel = new AlatModel();
    }

    public function index()
{
    try {
        $alat = $this->AlatModel->get_alat();
        if (count($alat) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data alat berhasil didapatkan!',
                'data' => $alat
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

public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'alat_kategori_id' => 'required|numeric',
            'alat_nama' => 'required|string|max:255',
            'alat_deskripsi' => 'required|string|max:200',
            'alat_hargaperhari' => 'required|numeric',
            'alat_stok' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data alat gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $alat = $this->AlatModel->create_alat($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data alat berhasil dibuat!',
                'data' => $alat
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
            'alat_kategori_id' => 'required|numeric',
            'alat_nama' => 'required|string|max:255',
            'alat_deskripsi' => 'required|string|max:200',
            'alat_hargaperhari' => 'required|numeric',
            'alat_stok' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data alat gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $alat = $this->AlatModel->update_alat($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data alat berhasil diupdate!',
                'data' => $alat
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
    try {
        $alat = $this->AlatModel->delete_alat($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data alat berhasil dihapus!',
            'data' => $alat
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => 'Terjadi kesalahan pada server.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
