<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Instructor extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function kelas() {
        return $this->hasMany(Kelas::class, 'instructor_id');
    }

}
