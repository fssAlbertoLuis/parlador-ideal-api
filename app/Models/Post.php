<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['content'];

    function user() {
        return $this->belongsTo(User::class);
    }

    function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y \\à\\s H:i');
    }
}
