<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cucu extends Model
{

    protected $table = 'cucu';
    use HasFactory;
    protected $fillable = ['nama','jk','anak_id','tanggal_lahir'];
}
