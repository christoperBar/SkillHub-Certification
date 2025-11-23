<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','instructor_id'];

    public function participants() {
        return $this->belongsToMany(Participant::class, 'registrations', 'kelas_id', 'participant_id')
            ->withPivot('created_at')
            ->withTimestamps();
    }
    public function registrations() {
        return $this->hasMany(Registration::class, 'kelas_id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }


}
