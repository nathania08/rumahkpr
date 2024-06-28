<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumens';
    protected $guarded = ['id'];

    public function Booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
