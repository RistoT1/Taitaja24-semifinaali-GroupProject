<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resepti extends Model
{
    protected $table = 'reseptit';
    protected $primaryKey = 'Resepti_ID';
    public $timestamps = false;
    protected $fillable = [
        'Nimi',
        'Kategoria',
        'Ainesosat',
        'Valmistusohje',
        'Kuva',
        'Tila',
    ];

}
