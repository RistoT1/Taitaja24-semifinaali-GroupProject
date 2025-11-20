<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuote extends Model 
{
    protected $table = 'tuotteet';
    protected $primaryKey = 'Tuote_ID'; 
    
    // Columns allowed for mass assignment
    protected $fillable = ['nimi', 'hinta','Kategoria','Tila','Kuva', 'kuvaus'];
}
