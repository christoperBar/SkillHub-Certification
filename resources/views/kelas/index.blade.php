@extends('layouts.layout')

@section('title', 'Daftar Kelas')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Kelas</h2>
    <a href="{{ route('kelas.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Tambah Kelas
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Kelas</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Instruktur</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($kelas as $c)
                <tr onclick="window.location='{{ route('kelas.show', $c->id) }}'"
                    class="border-b hover:bg-gray-50 cursor-pointer transition">

                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $c->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $c->instructor->name }}</td>

                    <td class="px-6 py-4 text-sm flex gap-3">
                        <a href="{{ route('kelas.edit', $c->id) }}"
                           class="text-blue-600 hover:underline"
                           onclick="event.stopPropagation()">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('kelas.destroy', $c->id) }}"
                              onsubmit="return confirm('Yakin hapus kelas ini?')"
                              onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Belum ada kelas yang terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
