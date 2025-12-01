<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuote extends Model
{
    protected $table = 'tuotteet';
    protected $primaryKey = 'Tuote_ID';
    public $timestamps = true;
    const UPDATED_AT = 'Muokattu';
    const CREATED_AT = 'Lisätty'; // if you have this too

    protected $fillable = [
        'Nimi',
        'Kategoria',
        'Kuvaus',
        'Hinta',
        'Kuva',
        'Tila',
    ];
    
}