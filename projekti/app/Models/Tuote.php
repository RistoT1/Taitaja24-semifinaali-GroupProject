<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuote extends Model
{
    protected $table = 'tuotteet';
    protected $primaryKey = 'Tuote_ID';
    public $timestamps = true;
    const UPDATED_AT = 'Muokattu';
    const CREATED_AT = 'LisÃ¤tty'; // ✅ Match the actual database column

    protected $fillable = [
        'Nimi',
        'Kategoria',
        'Kuvaus',
        'Hinta',
        'Kuva',
        'Tila',
    ];
    
    // Optional: Add a scope for easier ordering
    public function scopeOrderByCreated($query, $direction = 'desc')
    {
        return $query->orderBy(self::CREATED_AT, $direction);
    }
}