@extends('layouts.layout')

@section('title', 'Detail Kelas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">{{ $kela->name }}</h2>

    <p><strong>Instruktur:</strong> {{ $kela->instructor->name ?? 'Tidak ada instruktur' }}</p>
    <p class="mt-2"><strong>Deskripsi:</strong><br>{{ $kela->description }}</p>
    <hr class="my-4">

    <h3 class="text-xl font-semibold mb-2">Peserta Terdaftar</h3>

    @if($kela->registrations->count() == 0)
        <p class="text-gray-500">Belum ada peserta.</p>
    @else
        <ul class="list-disc ml-6">
            @foreach($kela->registrations as $reg)
                <li>{{ $reg->participant->name }} ({{ $reg->participant->email }})</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
