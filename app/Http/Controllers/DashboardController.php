<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Kelas;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalParticipants'  => Participant::count(),
            'totalKelas'         => Kelas::count(),
            'totalRegistrations' => Registration::count(),
            'registrations'      => Registration::with(['participant', 'kelas'])->get(),
        ]);
    }
}
