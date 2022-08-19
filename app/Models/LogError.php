<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'voter_id', 'message'];

    public function voter(){
        return $this->belongsTo(Voter::class, 'voter_id', 'id');
    }
}
