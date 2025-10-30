<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Departemen</title>
  @vite('resources/css/app.css')
</head>

<body class="h-screen flex items-center justify-center overflow-hidden">
  <div class="w-[480px] bg-[#F0F0F0] backdrop-blur-sm rounded-3xl p-10 shadow-2xl border border-slate-300">
    
    <h1 class="text-3xl font-bold text-center text-[#1B3C53] mb-8">Form Departemen</h1>
    
    <form action="{{ route('departments.store') }}" method="POST" class="space-y-6">
      @csrf
      
      <div>
        <label for="nama_departemen" class="block text-sm font-semibold text-slate-700 mb-1">
          Nama Departemen
        </label>
        <input
          type="text"
          id="nama_departemen"
          name="nama_departemen"
          placeholder="Masukkan nama departemen..."
          class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm 
                 focus:ring-2 focus:ring-[#456882] focus:outline-none transition"
        />
      </div>

      <div class="text-right pt-2">
        <a href="{{ route('departments.index') }}" type="submit"
            class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
            Kembali
          </a>
        <button
          type="submit"
          class="px-5 py-2 rounded-xl bg-[#1B3C53] text-white font-semibold shadow-md 
                 hover:bg-[#162f40] transition-all duration-300"
        >
          Simpan
        </button>
      </div>
    </form>
  </div>
</body>
</html>
