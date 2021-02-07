<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessMenu extends Model
{
    use HasFactory;
    protected $table = 'access_menu';
    protected $fillable = ['role_id','menu_id'];
}
