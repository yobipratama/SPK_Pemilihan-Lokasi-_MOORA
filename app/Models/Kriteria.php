<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function sub_kriteria(){
        return $this->hasMany(SubKriteria::class, 'kriterias_id');
    }
}
