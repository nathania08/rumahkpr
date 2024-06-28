<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'booking_id', 'id');
    }

    public function foto()
    {
        return $this->hasMany(FotoPembayaran::class, 'pembayaran_id', 'id');
    }

    public function properti()
    {
        return $this->hasOne(Properti::class, 'id', 'properti_id');
    }

}
