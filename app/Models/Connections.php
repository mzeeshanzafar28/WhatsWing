<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Servers;

class Connections extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'server_id',
        'port',
    ];
    
    public function server()
{
    return $this->belongsTo(Servers::class, 'server_id');
}
}
