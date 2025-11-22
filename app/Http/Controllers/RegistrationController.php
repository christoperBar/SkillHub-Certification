<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Participant;
use App\Models\Kelas;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::with(['participant','kelas'])
            ->latest()->paginate(10);

        return view('registrations.index', compact('registrations'));
    }

    public function create()
    {
        $participants = Participant::all();
        $kelas = Kelas::all();

        return view('registrations.create', compact('participants', 'kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'kelas_id'       => 'required|exists:kelas,id',
        ]);

        Registration::create([
            'participant_id' => $data['participant_id'],
            'kelas_id'       => $data['kelas_id'],
        ]);

        return redirect()->route('registrations.index')
            ->with('success', 'Registrasi berhasil ditambahkan');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('registrations.index')
            ->with('success', 'Registrasi berhasil dihapus');
    }

    public function filter(Request $request)
{
    $kelasList = Kelas::all();
    $participants = Participant::all();

    $selectedKelas = null;
    $selectedParticipant = null;
    $result = [];

    // Filter by kelas
    if ($request->filled('kelas_id')) {
        $selectedKelas = Kelas::with('registrations.participant')
            ->find($request->kelas_id);

        $result = $selectedKelas?->registrations ?? [];
    }

    // Filter by peserta
    if ($request->filled('participant_id')) {
        $selectedParticipant = Participant::with('registrations.kelas')
            ->find($request->participant_id);

        $result = $selectedParticipant?->registrations ?? [];
    }

    return view('registrations.filter', compact(
        'kelasList',
        'participants',
        'selectedKelas',
        'selectedParticipant',
        'result'
    ));
}

}
