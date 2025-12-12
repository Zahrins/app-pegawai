<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Laporan</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        
        <h1 class="text-2xl font-bold text-center mb-6 text-[#1B3C53]">Form Laporan</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <!-- Judul Lpaoran -->
            <div>
                <label for="report_title" class="block text-sm font-semibold text-slate-700 mb-1">
                Judul Laporan
                </label>
                <input
                type="text"
                id="report_title"
                name="report_title"
                placeholder="Masukkan judul laporan..."
                class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm 
                        focus:ring-2 focus:ring-[#456882] focus:outline-none transition"
                />
            </div>

            <!-- Kategori -->
            <div>
                <label for="document_categories" class="block text-sm font-medium text-slate-700 mb-1">Kategori Laporan</label>
                <select id="document_categories" name="document_categories" 
                    class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ old('document_categories') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Upload File -->
            <div>
                <label for="upload_file" class="block text-sm font-semibold text-slate-700 mb-1">
                    Upload File Laporan (Wajib)
                </label>

                <input
                    type="file"
                    id="upload_file"
                    name="upload_file"
                    class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm 
                        focus:ring-2 focus:ring-[#456882] focus:outline-none transition bg-white"
                />

                @error('upload_file')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-semibold text-slate-700 mb-1">
                Catatan (Opsional)
                </label>
                <input
                type="text"
                id="notes"
                name="notes"
                placeholder="Masukkan catatan..."
                class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm 
                        focus:ring-2 focus:ring-[#456882] focus:outline-none transition"
                />
            </div>


            <!-- Tombol -->
            <div class="flex justify-end">
                <a href="{{ route('reports.index') }}" type="submit"
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

            // Mengisi field Tanggal dan Waktu Masuk secara otomatis
            document.getElementById('tanggal').value = formatDate(today);
        });
    </script>
</body>
</html>
