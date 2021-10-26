<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * Join a string with a natural language conjunction at the end.
     * https://gist.github.com/angry-dan/e01b8712d6538510dd9c
     */
    public static function natural_language_join(array $list, $conjunction = 'and') {
        $last = array_pop($list);
        if ($list) {
            return implode(', ', $list) . ' ' . $conjunction . ' ' . $last;
        }
        return $last;
    }

    /**
     * Get the votes for this person.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
