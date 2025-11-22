@extends('layouts.layout')

@section('title', 'Daftar Peserta')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Peserta</h2>
    <a href="{{ route('participants.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Tambah Peserta
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-100 border-b">
            <tr >
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No. Telepon</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($participants as $p)
                <tr onclick="window.location='{{ route('participants.show', $p->id) }}'"
    class="border-b hover:bg-gray-50 cursor-pointer transition">
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $p->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $p->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $p->phone }}</td>
                    <td class="px-6 py-4 text-sm flex gap-3">
                        <a href="{{ route('participants.edit', $p->id) }}"
                           class="text-blue-600 hover:underline">Edit</a>

                        <form method="POST" action="{{ route('participants.destroy', $p->id) }}"
                              onsubmit="return confirm('Yakin hapus peserta ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada peserta yang terdaftar.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


