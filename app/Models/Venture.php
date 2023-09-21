<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venture extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function saleVenturePlots()
    {
        return $this->hasMany(VenturePlot::class)->where('plot_status', 1);
    }

    public function availableVenturePlots()
    {
        return $this->hasMany(VenturePlot::class)->where('plot_status', 0);
    }

    public function venturePlotImages()
    {
        return $this->hasMany(VenturePlotImage::class, 'venture_id', 'id');
    }

    public function getHighlightsAttribute($value)
    {
        return json_decode($value);
    }

    public function getNearByInfosAttribute($value)
    {
        return json_decode($value);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
}
