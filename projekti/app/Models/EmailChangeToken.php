<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailChangeToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'expires_at', // <--- ADD THIS LINE
    ];
    
    /**
     * Set the column type for Eloquent casting.
     * This is highly recommended for Carbon integration.
     */
    protected $casts = [
        'expires_at' => 'datetime',
    ];
}