<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Pegawai</title>
  @vite('resources/css/app.css')
</head>

<body class="h-screen flex items-center justify-center overflow-hidden">
  <div class="w-[90%] max-w-6xl bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300 flex flex-col justify-center">

    <h1 class="text-3xl font-bold text-center mb-10 text-[#1B3C53] tracking-wide">
      Form Pegawai
    </h1>

    <form action="{{ route('employees.store') }}" method="POST" 
          class="grid grid-cols-2 gap-10 divide-x divide-slate-300">
      @csrf

      <!-- KIRI: Informasi Pribadi -->
      <div class="space-y-4 pr-10 space-x-8">
        <h2 class="text-lg font-semibold text-slate-700 border-b pb-2 mb-3">
          Informasi Pribadi
        </h2>

        <!-- Nama Lengkap -->
        <div>
          <label for="nama_lengkap" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
          <input type="email" id="email" name="email"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>

        <!-- Nomor Telepon -->
        <div>
          <label for="nomor_telepon" class="block text-sm font-medium text-slate-700">Nomor Telepon</label>
          <input type="text" id="nomor_telepon" name="nomor_telepon"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>

        <!-- Tanggal Lahir -->
        <div>
          <label for="tanggal_lahir" class="block text-sm font-medium text-slate-700">Tanggal Lahir</label>
          <input type="date" id="tanggal_lahir" name="tanggal_lahir"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>

        <!-- Alamat -->
        <div>
          <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat</label>
          <input id="alamat" name="alamat"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>
      </div>

      <!-- KANAN: Informasi Pekerjaan -->
      <div class="space-y-4 pl-10">
        <h2 class="text-lg font-semibold text-slate-700 border-b pb-2 mb-3">
          Informasi Pekerjaan
        </h2>

        <!-- Departemen -->
        <div>
          <label for="department_id" class="block text-sm font-medium text-slate-700">Departemen</label>
          <select name="department_id" id="department_id"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
            <option value="">-- Pilih Departemen --</option>
            @foreach ($departments as $department)
              <option value="{{ $department->id }}">{{ $department->nama_departemen }}</option>
            @endforeach
          </select>
        </div>

        <!-- Jabatan -->
        <div>
          <label for="position_id" class="block text-sm font-medium text-slate-700">Jabatan</label>
          <select name="position_id" id="position_id"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
            <option value="">-- Pilih Jabatan --</option>
            @foreach ($positions as $position)
              <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
            @endforeach
          </select>
        </div>

        <!-- Tanggal Masuk -->
        <div>
          <label for="tanggal_masuk" class="block text-sm font-medium text-slate-700">Tanggal Masuk</label>
          <input type="date" id="tanggal_masuk" name="tanggal_masuk"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
        </div>

        <!-- Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
          <select id="status" name="status"
            class="mt-1 block w-full rounded-lg border border-slate-300 p-2.5 focus:ring-2 focus:ring-[#456882] focus:outline-none">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
        </div>

        <!-- Tombol -->
        <div class="text-right pt-6">
          <a href="{{ route('employees.index') }}" type="submit"
            class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
            Kembali
          </a>
          <button type="submit"
            class="px-5 py-2 rounded-lg bg-[#1B3C53] text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
            Simpan
          </button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
