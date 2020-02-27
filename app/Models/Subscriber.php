<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscriber extends Model
{
    const STATE_ACTIVE = "active";
    const STATE_BOUNCED = "bounced";
    const STATE_JUNK = "junk";
    const STATE_UNCONFIRMED = "unconfirmed";
    const STATE_UNSUBSCRIBED= "unsubscribed";

    protected $table = 'subscribers';
    protected $guarded = [];

    // ----------------------------------------------
    //  Relationships
    // ----------------------------------------------

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class,'subscriber_id');
    }

    // ----------------------------------------------
    //  Methods
    // ----------------------------------------------
}
