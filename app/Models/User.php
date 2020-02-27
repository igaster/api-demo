<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const STATE_ACTIVE = "active";
    const STATE_UNSUBSCRIBED= "unsubscribed";
    const STATE_JUNK = "junk";
    const STATE_BOUNCHED = "bounced";
    const STATE_UNCONFIRMED = "unconfirmed";

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ----------------------------------------------
    //  Relationships
    // ----------------------------------------------

     public function fields(): HasMany
     {
         return $this->hasMany(Field::class,'user_id');
     }

    // ----------------------------------------------
    //  Methods
    // ----------------------------------------------
}
