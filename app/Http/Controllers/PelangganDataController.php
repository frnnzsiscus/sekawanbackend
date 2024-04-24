<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PelangganDataModel;

class PelangganDataController extends Controller
{
    protected $PelangganDataModel;

    public function __construct()
    {
        $this->PelangganDataModel = new PelangganDataModel();
    }

    public function index()
    {
        $pelanggandata = $this->PelangganDataModel->get_pelanggandata();
        if (count($pelanggandata) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggandata berhasil didapatkan!',
                'data' => $pelanggandata
            ], 200);
        }
    }

    public function store(Request $request)
{
    try {
        $validator = Validator::make($request->all(), [
            'pelanggan_data_pelanggan_id' => 'required|string|max:150',
            'pelanggan_data_jenis' => 'required|string|max:200',
            'pelanggan_data_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggandata gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggandata = $this->PelangganDataModel->create_pelanggandata($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data pelanggandata berhasil dibuat!',
                'data' => $pelanggandata
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
            'pelanggan_data_pelanggan_id' => 'required|string|max:150',
            'pelanggan_data_jenis' => 'required|string|max:200',
            'pelanggan_data_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data pelanggandata gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $pelanggandata = $this->PelangganDataModel->update_pelanggandata($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data pelanggandata berhasil diupdate!',
                'data' => $pelanggandata
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
        $pelanggandata = $this->PelangganDataModel->delete_pelanggandata($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data pelanggan data berhasil dihapus!',
            'data' => $pelanggandata
        ], 200);
    }
}
