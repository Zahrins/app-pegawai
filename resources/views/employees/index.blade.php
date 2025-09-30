<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-b from-[#B6CEB4] via-[#D9E9CF] to-[#F0F0F0]">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pegawai</h1>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-[#D1D3D4] text-slate-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama Lengkap</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Nomor Telepon</th>
                        <th class="px-4 py-2 text-left">Tanggal Lahir</th>
                        <th class="px-4 py-2 text-left">Alamat</th>
                        <th class="px-4 py-2 text-left">Tanggal Masuk</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $employee->nama_lengkap }}</td>
                            <td class="px-4 py-2">{{ $employee->email }}</td>
                            <td class="px-4 py-2">{{ $employee->nomor_telepon }}</td>
                            <td class="px-4 py-2">{{ $employee->tanggal_lahir }}</td>
                            <td class="px-4 py-2">{{ $employee->alamat }}</td>
                            <td class="px-4 py-2">{{ $employee->tanggal_masuk }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-sm rounded 
                                    {{ $employee->status == 'aktif' ? 'bg-green-100 text-[#5D866C]' : 'bg-red-100 text-[#541212]' }}">
                                    {{ $employee->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('employees.show', $employee->id) }}"
                                   class="bg-sky-600 hover:bg-sky-500 text-white px-3 py-1 rounded-md text-sm">Detail</a>
                                <a href="{{ route('employees.edit', $employee->id) }}" 
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Edit</a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm"
                                        onclick="return confirm('Yakin mau hapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
