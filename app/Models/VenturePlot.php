<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenturePlot extends Model
{
    use HasFactory;

    public function ventureInfo()
    {
        return $this->hasOne(Venture::class, 'id', 'venture_id');
    }

    public function venturePlotCustomer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function venturePlotStaff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function venturePlotImages()
    {
        return $this->hasMany(VenturePlotImage::class);;
    }
}
