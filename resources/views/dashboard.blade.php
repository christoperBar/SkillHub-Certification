@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')

{{-- Statistik Atas --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <div class="bg-white p-6 rounded-lg shadow-sm border">
        <h3 class="text-gray-600 text-sm">Total Peserta</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalParticipants }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border">
        <h3 class="text-gray-600 text-sm">Total Kelas</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalKelas }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border">
        <h3 class="text-gray-600 text-sm">Total Registrasi</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalRegistrations }}</p>
    </div>

</div>

{{-- Tabel Registrasi --}}
<div class="bg-white p-6 brounded-lg shadow-sm border">
    <div class="flex justify-between pb-6">
        <h2 class="text-xl font-bold mb-4">Daftar Registrasi</h2>
        <a href="{{ route('registrations.filter') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Filter Registrasi
        </a>
    </div>


    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3 border">Nama Peserta</th>
                <th class="p-3 border">Kelas</th>
                <th class="p-3 border">Instruktur</th>
                <th class="p-3 border">Tanggal Registrasi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($registrations as $reg)
            <tr class="hover:bg-gray-50 transition">
                <td class="p-3 border">{{ $reg->participant->name }}</td>
                <td class="p-3 border">{{ $reg->kelas->name }}</td>
                <td class="p-3 border">{{ $reg->kelas->instructor->name }}</td>
                <td class="p-3 border">{{ $reg->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

@endsection
