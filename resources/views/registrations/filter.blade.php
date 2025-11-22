@extends('layouts.layout')

@section('title', 'Filter Registrasi')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">

    <h2  class="text-2xl font-bold mb-4">Filter Registrasi</h2>

    <form method="GET" action="{{ route('registrations.filter') }}" class="grid grid-cols-2 gap-4 mb-6">

        {{-- Filter kelas --}}
        <div>
            <label class="block font-semibold mb-1">Filter by Kelas</label>
            <select name="kelas_id"
                    class="w-full border-gray-300 rounded-lg"
                    onchange="this.form.submit()"
                    {{ request('participant_id') ? 'disabled' : '' }}>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelasList as $k)
                    <option value="{{ $k->id }}"
                        {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter peserta --}}
        <div>
            <label class="block font-semibold mb-1">Filter by Peserta</label>
            <select name="participant_id"
                    class="w-full border-gray-300 rounded-lg"
                    onchange="this.form.submit()"
                    {{ request('kelas_id') ? 'disabled' : '' }}>
                <option value="">-- Pilih Peserta --</option>
                @foreach ($participants as $p)
                    <option value="{{ $p->id }}"
                        {{ request('participant_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>


    </form>

    <hr class="my-4">

    {{-- HASIL FILTER --}}
    @if($selectedKelas)
        <h3 class="text-xl font-bold mb-2">Kelas: {{ $selectedKelas->name }}</h3>

        @if(count($result) === 0)
            <p class="text-gray-500">Tidak ada peserta terdaftar.</p>
        @else
            <ul class="list-disc ml-6">
                @foreach ($result as $reg)
                    <li>{{ $reg->participant->name }} — {{ $reg->participant->email }}</li>
                @endforeach
            </ul>
        @endif
    @endif

    <br>
    @if($selectedParticipant)
        <h3 class="text-xl font-bold mb-2">Peserta: {{ $selectedParticipant->name }}</h3>

        @if(count($result) === 0)
            <p class="text-gray-500">Tidak mengikuti kelas apapun.</p>
        @else
            <ul class="list-disc ml-6">
                @foreach ($result as $reg)
                    <li>{{ $reg->kelas->name }}</li>
                @endforeach
            </ul>
        @endif
    @endif

</div>
@endsection
