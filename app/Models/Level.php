<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'level';

    protected $fillable = [
        'nama_level',
    ];

    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
