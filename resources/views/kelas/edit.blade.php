@extends('layouts.layout')

@section('title', 'Edit Kelas')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Kelas</h2>

<form action="{{ route('kelas.update', $kela->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1 font-medium">Nama Kelas</label>
        <input type="text" name="name"
               class="w-full border rounded-lg px-4 py-2"
               value="{{ $kela->name }}" required>
    </div>

    <div>
        <label class="block mb-1 font-medium">Instruktur</label>
        <select name="instructor_id" class="w-full border rounded-lg px-4 py-2" required>
            @foreach($instructors as $ins)
                <option value="{{ $ins->id }}"
                    {{ $ins->id == $kela->instructor_id ? 'selected' : '' }}>
                    {{ $ins->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium">Deskripsi</label>
        <textarea name="description" class="w-full border rounded-lg px-4 py-2">{{ $kela->description }}</textarea>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Update
    </button>
</form>
@endsection
