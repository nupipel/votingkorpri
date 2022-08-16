<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'phone', 'candidate_id'];

    // public function candidate()
    // {
    //     return $this->belongsTo()
    // }
}
