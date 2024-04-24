<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    protected $AdminModel;

    public function __construct()
    {
        $this->AdminModel = new AdminModel();
    }

    public function index()
{
    try {
        $admin = $this->AdminModel->get_admin();
        if (count($admin) === 0) {
            return response()->json([], 204);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Data admin berhasil didapatkan!',
                'data' => $admin
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
            'admin_username' => 'required|string|max:50',
            'admin_password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data admin gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $admin = $this->AdminModel->create_admin($validator->validated());
            return response()->json([
                'status' => 201,
                'message' => 'Data admin berhasil dibuat!',
                'data' => $admin
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
            'admin_username' => 'required|string|max:50',
            'admin_password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Validasi pada data admin gagal!',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $admin = $this->AdminModel->update_admin($validator->validated(), $id);
            return response()->json([
                'status' => 200,
                'message' => 'Data admin berhasil diupdate!',
                'data' => $admin
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
        $admin = $this->AdminModel->delete_admin($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data admin berhasil dihapus!',
            'data' => $admin
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
