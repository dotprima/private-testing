<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anak extends Model
{
    protected $table = 'anak';
    use HasFactory;
    protected $fillable = ['nama','jk','keluarga_id','tanggal_lahir'];
}
