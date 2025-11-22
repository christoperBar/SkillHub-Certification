@extends('layouts.layout')

@section('title', 'Tambah Kelas')

@section('content')
<h2 class="text-2xl font-bold mb-6">Tambah Kelas</h2>

<form action="{{ route('kelas.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf

    <div>
        <label class="block mb-1 font-medium">Nama Kelas</label>
        <input type="text" name="name"
               class="w-full border rounded-lg px-4 py-2"
               required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Instruktur</label>
        <select name="instructor_id" class="w-full border rounded-lg px-4 py-2" required>
            <option value="">Pilih Instruktur</option>
            @foreach($instructors as $ins)
                <option value="{{ $ins->id }}">{{ $ins->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea name="description" class="w-full border rounded-lg px-4 py-2"></textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Simpan
    </button>
</form>
@endsection
