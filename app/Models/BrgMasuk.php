<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrgMasuk extends Model
{
    use HasFactory;

    protected $table = 'brg_masuk';

    protected $fillable = [
        'no_brg_masuk',
        'id_brg',
        'id_user',
        'tgl_brg_masuk',
        'jml_brg_masuk',
        'total',
        'created_at',
        'update_at',
    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
