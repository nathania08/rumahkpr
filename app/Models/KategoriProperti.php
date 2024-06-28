<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProperti extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function properti()
    {
        return $this->hasMany(Properti::class);
    }
}
