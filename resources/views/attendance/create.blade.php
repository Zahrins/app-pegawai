<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Absensi</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        
        <h1 class="text-2xl font-bold text-center mb-6 text-[#1B3C53]">Form Absensi Pegawai</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('attendance.store') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Karyawan (Dropdown) -->
            <div>
                <label for="karyawan_id" class="block text-sm font-medium text-slate-700 mb-1">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id" 
                    class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                    <option value="">Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tanggal (Otomatis) -->
            <div>
                <label for="tanggal" class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" 
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none" readonly>
                @error('tanggal') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Waktu Masuk (Otomatis) -->
            <div>
                <label for="waktu_masuk" class="block text-sm font-medium text-slate-700 mb-1">Jam Masuk</label>
                <input type="time" id="waktu_masuk" name="waktu_masuk" 
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none" readonly>
            </div>

            <!-- Waktu Keluar (Diisi 00:00 atau Null) -->
            <div>
                <label for="waktu_keluar" class="block text-sm font-medium text-slate-700 mb-1">Jam Keluar</label>
                <input type="time" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar', '') }}"
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                <small class="text-slate-500">Kosongkan jika absen keluar belum dilakukan.</small>
            </div>

            <!-- Status Absensi -->
            <div>
                <label for="status_absensi" class="block text-sm font-medium text-slate-700 mb-1">Status Absensi</label>
                <select id="status_absensi" name="status_absensi" 
                    class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status_absensi') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                <a href="{{ route('attendance.index') }}" type="submit"
                    class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
                    Kembali
                </a>
                <button type="submit" 
                        class="px-5 py-2 rounded-lg bg-[#1B3C53] text-white font-semibold hover:bg-slate-700 shadow-md">
                    Submit
                </button>
            </div>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();

            // memformat tanggal (YYYY-MM-DD)
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };

            // memformat waktu (HH:MM)
            const formatTime = (date) => {
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                return `${hours}:${minutes}`;
            };

            // Mengisi field Tanggal dan Waktu Masuk secara otomatis
            document.getElementById('tanggal').value = formatDate(today);
            document.getElementById('waktu_masuk').value = formatTime(today);
            
        });
    </script>
</body>
</html>
