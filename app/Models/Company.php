<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'country_id'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('joined_at');
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
