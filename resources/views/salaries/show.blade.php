<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji Pegawai</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#456882] to-[#F0F0F0] relative">
    <a href="{{ route('salaries.index') }}" class="absolute top-8 left-8 text-[#1B3C53] hover:text-gray-700">
        <i class="material-icons text-6xl border rounded-2xl p-3 bg-white hover:bg-slate-200">arrow_back</i>
    </a>

    <div class="w-[40%] bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h1 class="text-2xl font-bold text-center text-[#1B3C53] mb-6">Detail Gaji Pegawai</h1>
        
        <div class="flex justify-center">
            <table class="w-full">
                <tbody>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Nama Lengkap</th>
                        <td class="p-3">{{ $salary->karyawan->nama_lengkap }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Jabatan</th>
                        <td class="p-3">{{ $salary->karyawan->position->nama_jabatan }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Bulan</th>
                        <td class="p-3">{{ $salary->bulan }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Gaji Pokok</th>
                        <td class="p-3">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Tunjangan</th>
                        <td class="p-3">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Potongan</th>
                        <td class="p-3">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-b border-slate-300">
                        <th class="p-3 text-left font-semibold text-slate-700 w-1/3">Total Gaji</th>
                        <td class="p-3">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>