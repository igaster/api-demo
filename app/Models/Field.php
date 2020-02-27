<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Field extends Model
{
    const TYPE_DATE = "date";
    const TYPE_NUMBER= "number";
    const TYPE_STRING = "string";
    const TYPE_BOOLEAN = "boolean";

    protected $table = 'fields';
    protected $guarded = [];

    // ----------------------------------------------
    //  Relationships
    // ----------------------------------------------

     public function user() : BelongsTo
     {
         return $this->belongsTo(User::class, 'user_id');
     }

    // ----------------------------------------------
    //  Methods
    // ----------------------------------------------
}
