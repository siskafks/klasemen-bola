<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasemen extends Model
{
    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    protected $fillable = ['total_matches', 'win1', 'draw', 'lose', 'win_goal', 'lose_goal', 'points'];
}
