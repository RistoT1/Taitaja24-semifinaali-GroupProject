<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tilaus extends Model
{
    protected $table = 'tilaukset';  // adjust if your table is named differently
    protected $primaryKey = 'Tilaus_ID';

    public $timestamps = false; // disable if table does NOT have created_at / updated_at

    protected $fillable = [
        'User_ID',
        'TilausPvm',
        'Tila',
        'Kokonaishinta'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'User_ID');
    }

    public function tilausrivit()
    {
        return $this->hasMany(Tilausrivi::class, 'Tilaus_ID');
    }
}
