<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuangCao extends Model{
    protected $table = 'quangcao';
    protected $primaryKey = 'MaQC';
    protected $fillable = [
        'TieuDeQC',
        'DoanhNghiepQC',
        'NgayQC',
        'URL',
        'AnhQC',
        'ViTri',
        'TrangThai'
    ];
    public $timestamps = false;
}