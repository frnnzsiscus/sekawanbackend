<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganDataModel extends Model
{
    use HasFactory;

    protected $table = 'pelanggan_data';
    protected $primaryKey = 'pelanggan_data_id';
    protected $fillable = [
        'pelanggan_data_pelanggan_id',
        'pelanggan_data_jenis',
        'pelanggan_data_file',
    ];

    public function get_pelanggandata()
    {
        return self::all();
    }

    public function create_pelanggandata($data)
    {
        return self::create($data);
    }

    public function update_pelanggandata($data, $id)
{
    $pelanggan = self::find($id);
    $pelanggan->fill($data);
    $pelanggan->update();
    return $pelanggan;
}
public function delete_pelanggandata($id)
{
$pelanggan = self::find($id);
self::destroy($id);
return $pelanggan;
}
}
