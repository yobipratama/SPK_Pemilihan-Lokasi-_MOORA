<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriPenilaian extends Model
{
    use HasFactory;
    protected $table = 'kri_penilaians';
    protected $guarded = ['id'];

    public function sub_penilaian()
    {
        return $this->belongsTo(SubPenilaian::class);
    }
}
