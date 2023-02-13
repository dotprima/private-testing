<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keluarga extends Model
{
    protected $table = 'keluarga';
    use HasFactory;
    protected $fillable = ['nama_keluarga','nama_ayah','nama_ibu','tanggal_lahir_ayah','tanggal_lahir_ibu'];
}
