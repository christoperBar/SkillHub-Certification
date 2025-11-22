@extends('layouts.layout')

@section('title', 'Detail Peserta')

@section('content')

<h2 class="text-2xl font-bold mb-4">Detail Peserta</h2>

<div class="bg-white shadow-md rounded-lg p-6 border">
    <p class="mb-3">
        <span class="font-semibold">Nama:</span> {{ $participant->name }}
    </p>

    <p class="mb-3">
        <span class="font-semibold">Email:</span> {{ $participant->email }}
    </p>

    <p class="mb-3">
        <span class="font-semibold">Telepon:</span> {{ $participant->phone }}
    </p>

    <p class="mb-3">
        <span class="font-semibold">Alamat:</span> {{ $participant->address }}
    </p>

    <a href="{{ route('participants.index') }}"
       class="inline-block mt-4 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
       Kembali
    </a>
</div>

@endsection
