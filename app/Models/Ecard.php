<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecard extends Model
{
    use HasFactory;
    protected $fillable = [
        'ecard_id',
        'name',
        'image',
        'price',
        'note',
    ];
    
    /**
     * Get the user that owns the turkification.
     */
    public function user(): BelongsToMany
    {
        return $this->BelongsToMany(User::class);
    }
}
