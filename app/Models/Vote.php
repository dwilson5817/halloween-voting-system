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

    /**
     * Get the time until the results page unlocks.
     */
    public static function time_left()
    {
        date_default_timezone_set(config('app.timezone'));
        $timestamp = strtotime(config('app.results_time'));

        return ($timestamp * 1000) - round(microtime(true) * 1000);
    }
}
