<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPenilaian extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];

    public function KriPenilaian()
    {
        return $this->hasMany(KriPenilaian::class, 'sub_penilaian_id');
    }
}
