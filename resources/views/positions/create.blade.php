<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Jabatan</title>
  @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center overflow-hidden m-10">
  <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
    
    <h1 class="text-2xl font-bold text-center text-[#1B3C53] mb-6">Form Jabatan</h1>
    
    <form action="{{ route('positions.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Nama Jabatan -->
      <div>
        <label for="nama_jabatan" class="block text-sm font-medium text-slate-700">Nama Jabatan</label>
        <input type="text" id="nama_jabatan" name="nama_jabatan" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
      </div>

      <!-- Gaji Pokok -->
      <div>
        <label for="gaji_pokok" class="block text-sm font-medium text-slate-700">Gaji Pokok</label>
        <input type="text" id="gaji_pokok" name="gaji_pokok" 
               class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
      </div>

      <!-- Tombol -->
      <div class="text-right">
         <a href="{{ route('positions.index') }}" type="submit"
            class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
            Kembali
          </a>
        <button type="submit" 
                class="px-5 py-2 rounded-lg bg-[#1B3C53] text-white font-semibold hover:bg-slate-700 shadow-md">
          Simpan
        </button>
      </div>
    </form>
  </div>
</body>
</html>
