<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';

    protected $fillable = [
        'nama_bisnis',
        'jenis_usaha',
        'nama_pic',
        'no_hp',
        'no_pelanggan',
        'alamat',
        'foto',
    ];
}
