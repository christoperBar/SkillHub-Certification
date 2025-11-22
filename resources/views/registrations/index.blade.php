@extends('layouts.layout')

@section('title', 'Daftar Registrasi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Daftar Registrasi</h2>

    <a href="{{ route('registrations.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Registrasi Baru
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full border-collapse">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Peserta</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kelas</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($registrations as $r)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-6 py-3">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">{{ $r->participant->name }}</td>
                    <td class="px-6 py-3">{{ $r->kelas->name }}</td>
                    <td class="px-6 py-3">{{ $r->created_at }}</td>
                    <td class="px-6 py-3">
                        <form method="POST" action="{{ route('registrations.destroy', $r->id) }}"
                              onsubmit="return confirm('Hapus registrasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        Belum ada registrasi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
