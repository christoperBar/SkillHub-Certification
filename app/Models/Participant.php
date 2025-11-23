<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Participant extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','phone','address'];

    public function classes() {
        return $this->belongsToMany(Kelas::class, 'registrations', 'participant_id', 'kelas_id')
            ->withPivot('created_at')
            ->withTimestamps();
    }

    public function registrations() {
        return $this->hasMany(Registration::class , 'participant_id');
    }
}
