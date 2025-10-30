<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi Pegawai</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#456882] to-[#F0F0F0] relative">
    <a href="{{ route('attendance.index') }}" class="absolute top-8 left-8 text-[#1B3C53] hover:text-gray-700">
        <i class="material-icons text-6xl border rounded-2xl p-3 bg-white hover:bg-slate-200">arrow_back</i>
    </a>

    <div class="w-[40%] bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h1 class="text-2xl font-bold text-center text-[#1B3C53] mb-6">Detail Absensi Pegawai</h1>
        
        <div class="flex justify-center">
            <table class="w-full">
                <tbody>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Nama Lengkap</th>
                        <td class="p-3">{{ $attendance->karyawan->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Jabatan</th>
                        <td class="p-3">{{ $attendance->karyawan->position->nama_jabatan }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Tanggal</th>
                        <td class="p-3">{{ $attendance->tanggal }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Jam Masuk</th>
                        <td class="p-3">{{ $attendance->waktu_masuk }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Jam Keluar</th>
                        <td class="p-3">{{ $attendance->waktu_keluar }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Status</th>
                        <td class="p-3">{{ $attendance->status_absensi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>