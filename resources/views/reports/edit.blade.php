<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen flex items-center justify-center overflow-hidden m-10">

    <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h1 class="text-2xl font-bold text-center text-[#1B3C53] mb-6">Edit Laporan</h1>

        <form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Gagal Update!</strong>
                    <span class="block sm:inline">Periksa kembali data yang Anda masukkan.</span>
                </div>
            @endif

            {{-- Judul Laporan --}}
            <div>
                <label for="report_title" class="block text-sm font-semibold text-slate-700 mb-1">
                    Judul Laporan
                </label>

                <input type="text"
                       id="report_title"
                       name="report_title"
                       value="{{ old('report_title', $report->report_title) }}"
                       placeholder="Masukkan judul laporan..."
                       class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm
                              focus:ring-2 focus:ring-[#456882] focus:outline-none transition" />

                @error('report_title')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label for="document_categories" class="block text-sm font-medium text-slate-700 mb-1">
                    Kategori Laporan
                </label>

                <select id="document_categories"
                        name="document_categories"
                        class="mt-1 block w-full rounded-lg border border-slate-300 p-2
                               focus:ring-1 focus:ring-[#456882] focus:outline-none">
                    @foreach ($categories as $category)
                        <option value="{{ $category }}"
                            {{ old('document_categories', $report->document_categories) == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>

                @error('document_categories')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload File --}}
            <div>
                <label for="upload_file" class="block text-sm font-semibold text-slate-700 mb-1">
                    Upload File Laporan (Opsional)
                </label>

                <input type="file"
                       id="upload_file"
                       name="upload_file"
                       class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm
                              focus:ring-2 focus:ring-[#456882] focus:outline-none transition bg-white" />

                <p class="text-xs text-slate-600 mt-1">
                    File lama: <span class="font-semibold">{{ $report->upload_file }}</span>
                </p>

                @error('upload_file')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Notes --}}
            <div>
                <label for="notes" class="block text-sm font-semibold text-slate-700 mb-1">
                    Catatan (Opsional)
                </label>

                <input type="text"
                       id="notes"
                       name="notes"
                       value="{{ old('notes', $report->notes) }}"
                       placeholder="Masukkan catatan..."
                       class="w-full rounded-xl border border-slate-300 p-3 text-slate-700 shadow-sm
                              focus:ring-2 focus:ring-[#456882] focus:outline-none transition" />

                @error('notes')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-right pt-4">
                <a href="{{ route('reports.index') }}"
                   class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
                    Kembali
                </a>

                <button type="submit"
                        class="px-5 py-2 rounded-lg bg-[#1B3C53] text-white font-semibold hover:bg-slate-700 shadow-md">
                    Update Laporan
                </button>
            </div>

        </form>
    </div>

</body>
</html>
