<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen">
@extends('master')
@section('title', 'Daftar Absensi')
@section('content')

<div class="container mx-auto py-2">

    <!-- Judul + Filter -->
    <div class="flex flex-wrap items-end justify-between gap-4 mb-6 mt-2">

        <!-- Judul -->
        <div class="flex items-center gap-3">
            <img width="50" height="50" src="https://img.icons8.com/ios/50/groups.png" alt="groups"/>
            <h1 class="text-2xl font-bold text-[#1B3C53]">Daftar Absensi Pegawai</h1>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('attendance.index') }}" method="GET" class="flex items-end gap-3">

            <div class="flex">
                <input type="date" id="filter_date" name="filter_date"
                       value="{{ request('filter_date') }}"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm 
                              focus:border-[#1B3C53] focus:ring-[#1B3C53] sm:text-sm p-2.5">
            </div>

            <button type="submit"
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-white 
                           bg-[#1B3C53] rounded-lg hover:bg-[#2d5a7b] transition-colors duration-200 
                           shadow-md h-[42px]">
                <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                Filter
            </button>

            @if(request('filter_date'))
            <a href="{{ route('attendance.index') }}"
               class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-gray-700 
                      bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200 
                      shadow-md h-[42px]">
                <span class="material-symbols-outlined text-[16px]">close</span>
                Reset
            </a>
            @endif
        </form>

    </div>


    <!-- Tombol Tambah + Statistik -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

        <!-- Tombol Tambah Absensi -->
        <a href="{{ route('attendance.create') }}"
           class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white 
                  bg-gradient-to-r from-[#1B3C53] to-[#2d5a7b] rounded-xl hover:shadow-lg 
                  hover:scale-105 transition-all duration-300 shadow-md">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            Tambah Absensi
        </a>

        <!-- Kotak Statistik -->
        <div class="flex items-center gap-3">

            <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg shadow text-sm font-semibold">
                Hadir: {{ $total_hadir }}
            </div>

            <div class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg shadow text-sm font-semibold">
                Izin: {{ $total_izin }}
            </div>

            <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg shadow text-sm font-semibold">
                Sakit: {{ $total_sakit }}
            </div>

            <div class="px-4 py-2 bg-red-100 text-red-700 rounded-lg shadow text-sm font-semibold">
                Alpha: {{ $total_alpha }}
            </div>

        </div>
    </div>


    <!-- success message -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif


    <!-- tabel -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-200 rounded-lg mb-5">
            <thead class="bg-[#456882] text-slate-700">
            <tr>
                <th class="px-4 py-2 text-left font-medium text-white">Karyawan</th>
                <th class="px-4 py-2 text-center font-medium text-white">Tanggal</th>
                <th class="px-4 py-2 text-center font-medium text-white">Jam Masuk</th>
                <th class="px-4 py-2 text-center font-medium text-white">Jam Keluar</th>
                <th class="px-4 py-2 text-center font-medium text-white">Status</th>
                <th class="px-4 py-2 text-center font-medium text-white">Aksi</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">

            @forelse ($attendance_list as $attendance)
            <tr class="hover:bg-gray-50 text-slate-600 text-sm">

                <td class="px-4 py-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#1B3C53] to-[#456882] 
                                    rounded-full flex items-center justify-center text-white 
                                    font-semibold text-sm shadow-sm">
                            {{ strtoupper(substr($attendance->karyawan->nama_lengkap ?? 'N/A', 0, 2)) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-slate-800">
                                {{ $attendance->karyawan->nama_lengkap ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                </td>

                <td class="px-4 py-2 text-center">{{ $attendance->tanggal }}</td>
                <td class="px-4 py-2 text-center">{{ $attendance->waktu_masuk ?? '-' }}</td>
                <td class="px-4 py-2 text-center">{{ $attendance->waktu_keluar ?? '-' }}</td>

                <td class="px-4 py-2 text-center">
                    <span class="px-2 py-1 text-xs rounded-full
                          @if ($attendance->status_absensi == 'hadir') bg-green-100 text-green-700
                          @elseif ($attendance->status_absensi == 'izin') bg-yellow-100 text-yellow-700
                          @elseif ($attendance->status_absensi == 'sakit') bg-blue-100 text-blue-700
                          @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($attendance->status_absensi) }}
                    </span>
                </td>

                <td class="px-4 py-2 text-center">
                    <div class="flex justify-center items-center gap-1">

                        <a href="{{ route('attendance.show', $attendance->id) }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-md 
                                 text-blue-600 hover:bg-blue-100 hover:shadow-sm transition-all"
                           title="Detail">
                            <span class="material-symbols-outlined text-[10px]">info</span>
                        </a>

                        <a href="{{ route('attendance.edit', $attendance->id) }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-md 
                                 text-amber-600 hover:bg-amber-100 hover:shadow-sm transition-all"
                           title="Edit">
                            <span class="material-symbols-outlined text-[10px]">edit</span>
                        </a>

                        <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin mau hapus data ini?')"
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md 
                                         text-red-600 hover:bg-red-100 hover:shadow-sm transition-all"
                                    title="Hapus">
                                <span class="material-symbols-outlined text-[10px]">delete</span>
                            </button>
                        </form>

                    </div>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                    Belum ada data absensi {{ request('filter_date') ? 'untuk tanggal ini.' : 'yang tercatat.' }}
                </td>
            </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>

        <div class="mt-5 flex justify-center">
            {{ $attendance_list->onEachSide(1)->links('pagination::tailwind') }}
        </div>

@endsection
</body>
</html>
