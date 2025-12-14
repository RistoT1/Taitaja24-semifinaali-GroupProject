<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Osoite extends Model
{
    protected $table = 'osoitetiedot';

    protected $primaryKey = 'Osoite_ID';

    public $timestamps = false;

    protected $fillable = [
        'Osoite',
        'Postinumero',
        'Kaupunki',
        'Maa',
    ];
}
