<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * Get the person that was voted for.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
