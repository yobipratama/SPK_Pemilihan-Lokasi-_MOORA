<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPenilaian extends Model
{
    use HasFactory;
    protected $table = 'sub_penilaians';
    protected $guarded = ['id'];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }

    public function kri_penilaians()
    {
        return $this->hasMany(KriPenilaian::class);
    }
}
