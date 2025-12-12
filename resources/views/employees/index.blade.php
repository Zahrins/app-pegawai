<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen">
    @extends('master')
    @section('title', 'Daftar Pegawai')
    @section('content')

    <div class="container mx-auto py-2">

        <!-- Judul + Filter -->
        <div class="flex flex-wrap items-end justify-between gap-4 mb-6 mt-2">

            <div class="flex items-center gap-3">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/name-tag-woman.png" alt="name-tag-woman"/>
                <h1 class="text-2xl font-bold text-[#1B3C53]">Daftar Pegawai</h1>
            </div>

            <form action="{{ route('employees.index') }}" method="GET" class="flex items-end gap-4">

                <!-- Filter Status -->
                <div class="flex">
                    <select name="status" class="rounded-lg border-gray-300 px-4 shadow-sm p-2.5 focus:border-[#1B3C53] focus:ring-[#1B3C53]">
                        <option value="">Semua</option>
                        <option value="aktif" {{ $statusFilter=='aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $statusFilter=='nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-white bg-[#1B3C53] rounded-lg hover:bg-[#2d5a7b] transition-colors duration-200 shadow-md h-[42px]">
                    <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                    Filter
                </button>

                @if(request('status'))
                    <a href="{{ route('employees.index') }}" 
                    class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-md h-[42px]">
                        <span class="material-symbols-outlined text-[16px]">close</span>
                        Reset
                    </a>
                @endif

            </form>

        </div>

        <!-- Tombol Tambah + Statistik -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <a href="{{ route('employees.create') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-[#1B3C53] to-[#2d5a7b] rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300 shadow-md">
                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                Tambah Pegawai
            </a>

            <div class="flex gap-3">
                <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg shadow text-sm font-semibold">
                    Aktif: {{ $total_aktif }}
                </div>
                <div class="px-4 py-2 bg-red-100 text-red-700 rounded-lg shadow text-sm font-semibold">
                    Nonaktif: {{ $total_nonaktif }}
                </div>
                <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg shadow text-sm font-semibold">
                    Total: {{ $total_semua }}
                </div>
            </div>
        </div>

        <!-- success message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

    </div> 
    
    <div class="flex justify-center w-full rounded-sm">
        <div class="bg-white shadow-lg rounded-lg w-[98%]">

            <table class="w-full table-auto border border-gray-200 rounded-lg mb-5">
                <thead class="bg-[#456882] text-slate-700">
                    <tr>
                        <th class="px-4 py-2 text-center font-medium text-white">Nama Lengkap</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Email</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Nomor Telepon</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Tanggal Lahir</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Alamat</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Departemen</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Jabatan</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Tanggal Masuk</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Status</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                    <tr class="hover:bg-gray-50 text-slate-600 text-sm">

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#1B3C53] to-[#456882] rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                                    {{ strtoupper(substr($employee->nama_lengkap, 0, 2)) }}
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-semibold text-slate-800">{{ $employee->nama_lengkap }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-400 text-[16px]">mail</span>
                                <span>{{ $employee->email }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-400 text-[16px]">phone</span>
                                <span>{{ $employee->nomor_telepon }}</span>
                            </div>
                        </td>

                        <td class="px-4 py-2">{{ $employee->tanggal_lahir }}</td>
                        <td class="px-4 py-2">{{ $employee->alamat }}</td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $employee->department->nama_departemen ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $employee->position->nama_jabatan ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-2">{{ $employee->tanggal_masuk }}</td>

                        <td class="px-4 py-2 text-center">
                            <span class="px-2 py-1 text-sm rounded 
                                {{ $employee->status == 'aktif' ? 'bg-green-100 text-[#5D866C]' : 'bg-red-100 text-[#541212]' }}">
                                {{ $employee->status }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-center">
                            <div class="flex justify-center gap-1">

                                <a href="{{ route('employees.documents.index', $employee->id) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-md text-purple-600 hover:bg-purple-100">
                                    <span class="material-symbols-outlined text-[10px]">folder_shared</span>
                                </a>

                                <a href="{{ route('employees.show', $employee->id) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-md text-blue-600 hover:bg-blue-100">
                                    <span class="material-symbols-outlined text-[10px]">info</span>
                                </a>

                                <a href="{{ route('employees.edit', $employee->id) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-md text-amber-600 hover:bg-amber-100">
                                    <span class="material-symbols-outlined text-[10px]">edit</span>
                                </a>

                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin mau hapus data ini?')"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-md text-red-600 hover:bg-red-100">
                                        <span class="material-symbols-outlined text-[10px]">delete</span>
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

    <!-- PAGINATION -->
    <div class="mt-5 flex justify-center">
        {{ $employees->onEachSide(1)->links('pagination::tailwind') }}
    </div>

    @endsection
</body>
</html>
