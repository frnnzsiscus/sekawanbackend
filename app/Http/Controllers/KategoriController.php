<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    protected $KategoriModel;

    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        $kategori = $this->KategoriModel->get_kategori();
        if (count($kategori) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data kategori berhasil didapatkan!',
                'data' => $kategori
            ], 200);
        }
    }

    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data kategori gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $kategori = $this->KategoriModel->create_kategori($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data kategori berhasil dibuat!',
                'data' => $kategori
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
            'kategori_nama' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data kategori gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $kategori = $this->KategoriModel->update_kategori($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data kategori berhasil diupdate!',
                'data' => $kategori
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
        $kategori = $this->KategoriModel->delete_kategori($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data kategori berhasil dihapus!',
            'data' => $kategori
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