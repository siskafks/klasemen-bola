<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'club_id';
    protected $fillable = ['club_name', 'club_city'];
}
