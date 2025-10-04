<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#B6CEB4] to-[#F0F0F0]">
    <div class="w-[40%] h-[50%] bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h1 class="text-2xl font-bold text-center mb-6">Detail Pegawai</h1>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700" class="px-4 py-2 text-left font-semibold text-slate-700">Nama Lengkap</th>
                <td class="px-18">{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700" class="block text-sm font-medium text-slate-700">Email</th>
                <td class="px-18">{{ $employee->email }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700">Nomor Telepon</th>
                <td class="px-18">{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700">Tanggal Lahir</th>
                <td class="px-18">{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700">Alamat</th>
                <td class="px-18">{{ $employee->alamat }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700">Tanggal Masuk</th>
                <td class="px-18">{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr class="border-b border-slate-300">
                <th class="p-3 text-left font-semibold text-slate-700">Status</th>
                <td class="px-18">{{ $employee->status }}</td>
            </tr>
        </table>
    </div>
</body>
</html>