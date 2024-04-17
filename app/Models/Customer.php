<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj',
        'foundation',
        'group_id'
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
