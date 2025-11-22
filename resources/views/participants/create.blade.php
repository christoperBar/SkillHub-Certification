@extends('layouts.layout')
@section('title', 'Tambah Peserta')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Peserta</h2>

<form method="POST" action="{{ route('participants.store') }}" class="bg-white p-6 rounded shadow border">
    @csrf

    <div class="mb-4">
        <label class="block text-sm font-semibold">Nama</label>
        <input type="text" name="name" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold">Email</label>
        <input type="email" name="email" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold">Telepon</label>
        <input type="text" name="phone" class="w-full border p-2 rounded" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-semibold">Alamat</label>
        <input type="text" name="address" class="w-full border p-2 rounded" required>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Simpan
    </button>
</form>

@endsection
