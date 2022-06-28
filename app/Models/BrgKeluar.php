<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgKeluar extends Model
{
    use HasFactory;

    protected $table = 'brg_keluar';

    protected $fillable = [
        'no_brg_keluar',
        'id_brg',
        'id_user',
        'tgl_brg_keluar',
        'jml_brg_keluar',
        'total',
        'created_at',
        'update_at',
    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
