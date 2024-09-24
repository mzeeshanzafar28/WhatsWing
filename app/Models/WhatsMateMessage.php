<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsMaticMessage extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = [
    "user_id", 
	"api_key",
    "phone_no",		
    "message",
    "status",
    "priority",
    "type",
    "data",
    "status_updated_at",
    "scheduled_at"
    ];
}
