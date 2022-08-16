<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "image"];

    protected $appends = ['image_url'];

    public function voters()
    {
        return $this->hasMany(Voter::class, 'candidate_id', 'id');
    }
    public function deleteImage()
    {
        Storage::disk('public_uploads')->delete($this->attributes['image']);
    }
}
