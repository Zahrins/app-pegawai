<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#B6CEB4] to-[#D9E9CF]">
    <div class="w-1/2 justify-center bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Data Pegawai</h2>
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="flex justify-center mt-15">
                <tr>
                    <td class="pr-20">Nama Lengkap</td>
                    <td><input type="text" class="w-70 mt-1 block  rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                name="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" ></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email"class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                 name="email" value="{{ old('email', $employee->email) }}"></td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td><input type="text" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                name="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td><input type="date" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                name="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                name="alamat" value="{{ old('alamat', $employee->alamat) }}"></td>
                </tr>
                <tr>
                    <td>Tanggal Masuk</td>
                    <td><input type="date" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"
                                name="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
                            <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ old('status', $employee->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">
                        <button type="submit" class="px-5 py-2 mt-10 rounded-lg bg-slate-600 text-white font-semibold hover:bg-slate-700 shadow-md">Update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>