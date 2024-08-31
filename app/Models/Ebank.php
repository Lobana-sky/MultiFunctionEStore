<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebank extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_id',
        'name',
        'image',
        'note',
        'price',

    ];
    
    /**
     * Get the user that owns the turkification.
     */
    public function user(): BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }
}
