<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'Qliq',
        'Qoil',
        'date',
        'company_id'
    ];

}
