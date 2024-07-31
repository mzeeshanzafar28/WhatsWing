<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class APIs extends Model
{
    use HasFactory;
    protected $table = 'apis';
    protected $fillable = [
        'user_id', 
        'api_key'
    ];

}
