<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'buy',
        'sell',
        'date'
    ];

    protected function buy(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'Rp ' . number_format($value),
            // set: fn ($value) => $date_parts = explode('/', $value)
        );
    }

    protected function sell(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'Rp ' . number_format($value),
            // set: fn ($value) => $date_parts = explode('/', $value)
        );
    }


    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('d-m-Y', strtotime($value)),
            // set: fn ($value) => $date_parts = explode('/', $value)
        );
    }
    // private function getStartDateValue()
    // {
    //     return date('m/d/Y', strtotime($this->attributes['start_date']));
    // }

    // private function setStartDateValue($value)
    // {
    //     $date_parts = explode('/', $value);
    //     $this->attributes['start_date'] = $date_parts[2] . '-' . $date_parts[0] . '-' . $date_parts[1];
    // }
}
