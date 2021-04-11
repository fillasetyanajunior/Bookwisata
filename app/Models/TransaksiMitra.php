<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMitra extends Model
{
    use HasFactory;
    protected $table = 'transaksi_mitra';
    protected $guarded = ['id'];
}
