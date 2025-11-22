@extends('layouts.layout')

@section('title', 'Tambah Instruktur')

@section('content')
<h2 class="text-2xl font-bold mb-6">Tambah Instruktur</h2>

<form action="{{ route('instructors.store') }}" method="POST"
      class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <div>
        <label class="block mb-1 font-medium">Nama Instruktur</label>
        <input type="text" name="name"
               class="w-full border rounded-lg px-4 py-2"
               placeholder="Masukkan nama instruktur" required>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Simpan
    </button>
</form>
@endsection
