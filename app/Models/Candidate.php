<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "image"];

    public function voters()
    {
        return $this->hasMany(Voter::class, 'candidate_id', 'id');
    }
}
