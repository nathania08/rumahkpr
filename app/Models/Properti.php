<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properti extends Model
{
    use HasFactory;
    protected $table = 'properties';
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriProperti::class, 'kategori_id', 'id');
    }

    public function foto()
    {
        return $this->hasMany(FotoProperti::class, 'properti_id', 'id');
    }

    public function banner()
    {
        return $this->hasOne(FotoProperti::class, 'properti_id', 'id')->where('is_banner', 1);
    }
}
