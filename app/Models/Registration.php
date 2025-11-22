<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['participant_id','kelas_id'];

    public function participant() {
        return $this->belongsTo(Participant::class, 'participant_id');
    }


    public function kelas() {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
