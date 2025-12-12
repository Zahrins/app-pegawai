@extends('master')
@section('title', 'Dokumen Pegawai: ' . $employee->nama_lengkap)

@section('content')
<div class="container mx-auto px-6 py-8">
    
    <div class="flex items-center gap-3 mb-6 mt-5">
        <span class="material-symbols-outlined text-4xl text-[#1B3C53]">folder_open</span>
        <h1 class="text-2xl font-bold text-[#1B3C53]">Kelola Dokumen Pegawai: {{ $employee->nama_lengkap }}</h1>
    </div>

    <!-- Button kembali ke Daftar Pegawai -->
    <a href="{{ route('employees.index') }}" 
       class="inline-flex items-center mb-6 gap-1 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 shadow-md">
       <span class="material-symbols-outlined text-[16px]">arrow_back</span>
       Kembali ke Daftar Pegawai
    </a>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Container Utama: Form Upload (1/3) dan Daftar Dokumen (2/3) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri (1/3): Form Upload Dokumen -->
        <div class="md:col-span-1 bg-white p-6 shadow-lg rounded-xl">
            <h2 class="text-xl font-bold text-[#1B3C53] mb-4 border-b pb-2">Unggah Dokumen Baru</h2>
            
            <form action="{{ route('employees.documents.store', $employee) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="document_type" class="block text-sm font-medium text-gray-700">Jenis Dokumen</label>
                    <select id="document_type" name="document_type" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B3C53] focus:ring-[#1B3C53] sm:text-sm p-2">
                        <option value="">Pilih Jenis</option>
                        @foreach ($document_types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('document_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="file" class="block text-sm font-medium text-gray-700">Pilih File (Max 5MB)</label>
                    <input type="file" id="file" name="file" required
                           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2">
                    @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700">Tanggal Kedaluwarsa (Opsional)</label>
                    <input type="date" id="expiry_date" name="expiry_date"
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#1B3C53] focus:ring-[#1B3C53] sm:text-sm p-2">
                    @error('expiry_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Button Submit -->
                <button type="submit" 
                        class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-[#1B3C53] to-[#2d5a7b] rounded-lg hover:shadow-lg  duration-200 shadow-md">
                    <span class="material-symbols-outlined text-base">upload</span>
                    Unggah Dokumen
                </button>
            </form>
        </div>

        <!-- Kolom Kanan (2/3): Daftar Dokumen -->
        <div class="md:col-span-2 bg-white p-6 shadow-lg rounded-xl">
            <h2 class="text-xl font-bold text-[#1B3C53] mb-4 border-b pb-2">Daftar Dokumen Tercatat</h2>
            
            @forelse ($documents as $document)
                <div class="flex items-center justify-between p-3 border-b hover:bg-gray-50 hover:rounded-xl">
                    <div class="flex items-center">
                        
                        <span class="material-symbols-outlined text-2xl text-blue-600 mr-3">
                            @if (str_contains($document->filename, '.pdf'))
                                picture_as_pdf
                            @elseif (str_contains($document->filename, 'doc') || str_contains($document->filename, 'docx'))
                                description
                            @else
                                image
                            @endif
                        </span>
                        
                        <div>
                            <p class="font-semibold text-slate-800">{{ $document->document_type }}</p>
                            <p class="text-xs text-gray-500">{{ $document->filename }}</p>
                            @if ($document->expiry_date)
                                <p class="text-xs mt-1 
                                    @if(\Carbon\Carbon::parse($document->expiry_date)->isPast()) text-red-500 font-bold @else text-yellow-600 @endif
                                ">
                                    Kedaluwarsa: {{ \Carbon\Carbon::parse($document->expiry_date)->format('d F Y') }}
                                    @if(\Carbon\Carbon::parse($document->expiry_date)->isPast())
                                        <span class="text-xs font-bold text-red-700 ml-1">(EXPIRED)</span>
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <!-- Button Detail -->
                        <a href="{{ route('employees.documents.show', [$employee, $document]) }}"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-md text-yellow-600 hover:bg-yellow-100"
                           title="Lihat/Detail">
                           <span class="material-symbols-outlined text-[20px]">info</span>
                        </a>
                        <!-- Button Download -->
                        <a href="{{ Storage::disk('public')->url($document->file_path) }}" target="_blank"
                           class="inline-flex items-center justify-center w-8 h-8 rounded-md text-green-600 hover:bg-green-100"
                           title="Lihat/Download">
                           <span class="material-symbols-outlined text-[20px]">download</span>
                        </a>

                        <!-- Button Hapus -->
                        <form action="{{ route('employees.documents.destroy', [$employee, $document]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-md text-red-600 hover:bg-red-100"
                                    onclick="return confirm('Yakin mau hapus dokumen ini? File juga akan dihapus dari server.')"
                                    title="Hapus Dokumen">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-4">Belum ada dokumen yang diunggah untuk pegawai ini.</p>
            @endforelse
        </div>
        
    </div>
</div>
@endsection