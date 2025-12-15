<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'User_ID';
    public $timestamps = true;

    const UPDATED_AT = 'Muokattu';
    const CREATED_AT = 'Luotu';

    protected $fillable = [
        'Nimi',
        'SÃ¤hkÃ¶posti',  // ✅ Changed from 'Sähköposti'
        'Puhelin',
        'Osoite_ID',
        'SalasanaHash',
        'email_verified_at',
    ];

    // app/Models/User.php
    public function osoite()
    {
        return $this->belongsTo(Osoite::class, 'Osoite_ID', 'Osoite_ID');
    }

    protected $hidden = [
        'SalasanaHash',
    ];

    protected $guarded = ['Rooli'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Password column for authentication
    public function getAuthPassword()
    {
        return $this->SalasanaHash;
    }

    // **REMOVED getAuthIdentifierName() - let Laravel use primary key**
    // Laravel will now use User_ID as the identifier (correct!)

    // Map 'email' attribute to your column
    public function getEmailAttribute()
    {
        return $this->SÃ¤hkÃ¶posti;  // ✅ Changed
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['SÃ¤hkÃ¶posti'] = $value;  // ✅ Changed
    }

    // Map 'name' attribute to your column
    public function getNameAttribute()
    {
        return $this->Nimi;
    }

    // Route email notifications to your email column
    public function routeNotificationForMail()
    {
        return $this->SÃ¤hkÃ¶posti;  // ✅ Changed
    }

    // **CRITICAL: Tell Laravel which column to use for login**
    public function getEmailForPasswordReset()
    {
        return $this->SÃ¤hkÃ¶posti;  // ✅ Changed
    }
}