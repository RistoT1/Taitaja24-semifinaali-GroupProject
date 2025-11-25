<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'User_ID';
    public $timestamps = true;

    const UPDATED_AT = 'Muokattu';
    const CREATED_AT = 'Luotu';

    protected $fillable = [
        'Nimi',
        'Sähköposti',
        'Puhelin',
        'SalasanaHash',
    ];

    protected $hidden = [
        'SalasanaHash',
    ];

    protected $guarded = ['Rooli'];

    // Tell Laravel which column contains the password hash
    public function getAuthPassword()
    {
        return $this->SalasanaHash;
    }

    // Tell Laravel which column to use for the username/email
    public function getAuthIdentifierName()
    {
        return 'Sähköposti';
    }
}