<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Gaji Pegawai</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen">

    @extends('master')
    @section('title', 'Daftar Gaji Pegawai')
    @section('content')

    <div class="container mx-auto py-2">
        <div class="flex items-center gap-3 mb-6 mt-2">
            <img width="50" height="50" src="https://img.icons8.com/ios/50/salary-female.png" alt="salary-female"/>
            <h1 class="text-2xl font-bold text-[#1B3C53]">Daftar Gaji Pegawai</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
                <p class="font-bold">Berhasil</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <a href="{{ route('salaries.create') }}" 
               class="inline-flex items-center mb-8 gap-2 px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-[#1B3C53] to-[#2d5a7b] rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300 shadow-md">
                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                Tambah Gaji Pegawai
        </a>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg mb-5">
                <thead class="bg-[#456882] text-slate-700">
                    <tr>
                        <th class="px-4 py-2 text-center font-medium text-white">Nama Lengkap</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Bulan Gaji</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Gaji Pokok</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Tunjangan</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Potongan</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Total Gaji</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($salaries as $salary)
                        <tr class="hover:bg-gray-50 text-slate-600 text-sm">
                            <td class="px-4 py-2">{{ $salary->karyawan->nama_lengkap }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($salary->bulan)->isoFormat('MMMM YYYY') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 font-semibold text-center">
                                Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-1">
                                    <a href="{{ route('salaries.show', $salary->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-md text-blue-600 hover:bg-blue-100 hover:shadow-sm transition-all duration-200"
                                       title="Detail">
                                        <span class="material-symbols-outlined text-[10px] font-light">info</span>
                                    </a>
                                    <a href="{{ route('salaries.edit', $salary->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-md text-amber-600 hover:bg-amber-100 hover:shadow-sm transition-all duration-200"
                                       title="Edit">
                                        <span class="material-symbols-outlined text-[10px] font-light">edit</span>
                                    </a>
                                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-md text-red-600 hover:bg-red-100 hover:shadow-sm transition-all duration-200"
                                                onclick="return confirm('Yakin mau hapus data ini?')"
                                                title="Hapus">
                                            <span class="material-symbols-outlined text-[10px] font-light">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endsection
</body>
</html>
