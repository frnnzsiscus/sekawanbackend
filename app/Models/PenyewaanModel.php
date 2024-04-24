<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaanModel extends Model
{
    use HasFactory;

    protected $table = 'penyewaan';
    protected $primaryKey = 'penyewaan_id';
    protected $fillable = [
        'penyewaan_pelanggan_id',
        'penyewaan_tglsewa',
        'penyewaan_tglkembali',
        'penyewaan_sttspembayaran',
        'penyewaan_sttskembali',
        'penyewaan_totalharga',
        
    ];

    public function get_penyewaan()
    {
        return self::all();
    }

    public function create_penyewaan($data)
    {
        return self::create($data);
    }

    public function update_penyewaan($data, $id)
{
    $penyewaandetail = self::find($id);
    $penyewaandetail->fill($data);
    $penyewaandetail->update();
    return $penyewaandetail;
}
public function delete_penyewaan($id)
{
$penyewaandetail = self::find($id);
self::destroy($id);
return $penyewaandetail;
}
}
