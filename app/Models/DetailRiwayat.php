<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRiwayat extends Model
{
    use HasFactory;
    protected $table = 'detail_riwayat';
    protected $guarded = ['id'];
    public $timestamps = false;
}
