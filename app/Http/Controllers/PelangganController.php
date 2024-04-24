<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PelangganModel;


class PelangganController extends Controller
{
    protected $PelangganModel;

    public function __construct()
    {
        $this->PelangganModel = new PelangganModel();
    }

    public function index()
    {
        $pelanggan = $this->PelangganModel->get_pelanggan();
        if (count($pelanggan) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil didapatkan!',
                'data' => $pelanggan
            ], 200);
        }
    }

    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'pelanggan_nama' => 'required|string|max:150',
            'pelanggan_alamat' => 'required|string|max:200',
            'pelanggan_notelp' => 'required|string|max:13',
            'pelanggan_email' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggan = $this->PelangganModel->create_pelanggan($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data pelanggan berhasil dibuat!',
                'data' => $pelanggan
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
            'pelanggan_nama' => 'required|string|max:150',
            'pelanggan_alamat' => 'required|string|max:200',
            'pelanggan_notelp' => 'required|string|max:13',
            'pelanggan_email' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggan gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggan = $this->PelangganModel->update_pelanggan($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggan berhasil diupdate!',
                'data' => $pelanggan
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
        $pelanggan = $this->PelangganModel->delete_pelanggan($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data pelanggan berhasil dihapus!',
            'data' => $pelanggan
        ], 200);
    }
}
