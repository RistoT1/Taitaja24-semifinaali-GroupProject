<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tilausrivi extends Model
{
    protected $table = 'tilausrivit'; // or 'tilausrivit' depending on DB table name
    protected $primaryKey = 'TilausriviID'; // custom primary key

    public $timestamps = false; // disable if table has no created_at / updated_at columns

    protected $fillable = [
        'Tilaus_ID',
        'Tuote_ID',
        'Määrä',
        'Hinta'
    ];

    // Relationships:
    public function tilaus()
    {
        return $this->belongsTo(Tilaus::class, 'Tilaus_ID');
    }

    public function tuote()
    {
        return $this->belongsTo(Tuote::class, 'Tuote_ID');
    }
}
