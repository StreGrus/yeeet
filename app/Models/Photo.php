<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto'
    ];

    public function package_tour()
    {
        return $this->belongsTo(PackageTour::class);
    }
}
