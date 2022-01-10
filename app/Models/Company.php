<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function factQuantity(): HasMany
    {
        return $this->hasMany(FactQuantity::class);
    }

    public function forecastQuantity(): HasMany
    {
        return $this->hasMany(ForecastQuantity::class);
    }
}
