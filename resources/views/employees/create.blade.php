<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pegawai</title>
  @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#B6CEB4] to-[#D9E9CF] m-10">
  <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
    
    <h1 class="text-2xl font-bold text-center mb-6">Form Pegawai</h1>
    
    <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nama Lengkap -->
      <div>
        <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
        <input type="text" id="nama_lengkap" name="nama_lengkap" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" id="email" name="email" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
      </div>

      <!-- Nomor Telepon -->
      <div>
        <label for="nomor_telepon" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
      </div>

      <!-- Tanggal Lahir -->
      <div>
        <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
      </div>

      <!-- Alamat -->
      <div>
        <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat</label>
        <input id="alamat" name="alamat" 
                  class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none"></input>
      </div>

      <!-- Tanggal Masuk -->
      <div>
        <label for="tanggal_masuk" class="block text-sm font-medium text-slate-700">Tanggal Masuk</label>
        <input type="date" id="tanggal_masuk" name="tanggal_masuk" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
      </div>

      <!-- Status -->
      <div>
        <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
        <select id="status" name="status" 
                class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#96A78D] focus:outline-none">
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>

      <!-- Tombol -->
      <div class="text-right">
        <button type="submit" 
                class="px-5 py-2 rounded-lg bg-slate-600 text-white font-semibold hover:bg-slate-700 shadow-md">
          Simpan
        </button>
      </div>
    </form>
  </div>
</body>
</html>
