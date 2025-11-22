@extends('layouts.layout')

@section('title', 'Registrasi Peserta')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto">

    <h2 class="text-2xl font-bold mb-4">Registrasi Peserta ke Kelas</h2>

    <form method="POST" action="{{ route('registrations.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Pilih Peserta</label>
            <select name="participant_id"
                    class="w-full border-gray-300 rounded-lg">
                <option value="">-- Pilih Peserta --</option>
                @foreach ($participants as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} — {{ $p->email }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Pilih Kelas</label>
            <select name="kelas_id"
                    class="w-full border-gray-300 rounded-lg">
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Registrasi
        </button>
    </form>
</div>
@endsection
