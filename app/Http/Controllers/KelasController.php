<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Instructor;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('instructor')->latest()->paginate(10);
        return view('kelas.index', compact('kelas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::all();
        return view('kelas.create', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructors,id',
            'description' => 'nullable|string',
        ]);

        Kelas::create($data);
        return redirect()->route('kelas.index')->with('success','Kelas berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        $kela->load('instructor', 'registrations.participant');
        return view('kelas.show', compact('kela'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $instructors = Instructor::all();
        return view('kelas.edit', compact('kela', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'instructor_id' => 'required|exists:instructors,id',
            'description' => 'nullable|string',
        ]);

        $kela->update($data);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('kelas.index')->with('success','Kelas berhasil dihapus');
    }
}
