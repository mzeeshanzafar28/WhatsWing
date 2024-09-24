<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Connections;
class Servers extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'status',
        'limit',
    ];
    public function connections()
{
    return $this->hasMany(Connections::class, 'server_id');
}
}
