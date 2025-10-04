<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-b from-[#B6CEB4] to-[#F0F0F0]">
    @extends('master')
    @section('title', 'Daftar Pegawai')
    @section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-xl font-bold text-gray-800 mb-6 mt-5">Daftar Pegawai</h1>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-[#D1D3D4] text-slate-700">
                    <tr>
                        <th class="px-4 py-2 text-center font-medium">Nama Lengkap</th>
                        <th class="px-4 py-2 text-center font-medium">Email</th>
                        <th class="px-4 py-2 text-center font-medium">Nomor Telepon</th>
                        <th class="px-4 py-2 text-center font-medium">Tanggal Lahir</th>
                        <th class="px-4 py-2 text-center font-medium">Alamat</th>
                        <th class="px-4 py-2 text-center font-medium">Tanggal Masuk</th>
                        <th class="px-4 py-2 text-center font-medium">Status</th>
                        <th class="px-4 py-2 text-center font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                        <tr class="hover:bg-gray-50 text-slate-600 text-sm">
                            <td class="px-4 py-2">{{ $employee->nama_lengkap }}</td>
                            <td class="px-4 py-2">{{ $employee->email }}</td>
                            <td class="px-4 py-2">{{ $employee->nomor_telepon }}</td>
                            <td class="px-4 py-2">{{ $employee->tanggal_lahir }}</td>
                            <td class="px-4 py-2">{{ $employee->alamat }}</td>
                            <td class="px-4 py-2">{{ $employee->tanggal_masuk }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 text-sm rounded 
                                    {{ $employee->status == 'aktif' ? 'bg-green-100 text-[#5D866C]' : 'bg-red-100 text-[#541212]' }}">
                                    {{ $employee->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-x-1">
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('employees.show', $employee->id) }}" class="text-sky-600 hover:text-sky-700">
                                        <span class="material-symbols-outlined text-[10px] font-light align-middle">info</span>
                                    </a>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-yellow-600 hover:text-yellow-700">
                                        <span class="material-symbols-outlined text-[10px] font-light align-middle">edit</span>
                                    </a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700"
                                            onclick="return confirm('Yakin mau hapus data ini?')">
                                            <span class="material-symbols-outlined text-[10px] font-light align-middle">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endsection
    </div>
</body>
</html>
