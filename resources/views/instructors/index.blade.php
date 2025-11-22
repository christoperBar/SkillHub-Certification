@extends('layouts.layout')

@section('title', 'Daftar Instruktur')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Instruktur</h2>

    <a href="{{ route('instructors.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Tambah Instruktur
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($instructors as $i)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $i->name }}</td>
                    <td class="px-6 py-4 text-sm">

                        <form method="POST" action="{{ route('instructors.destroy', $i->id) }}"
                              onsubmit="return confirm('Hapus instruktur ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                        Belum ada instruktur terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
