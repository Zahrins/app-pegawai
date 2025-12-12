@extends('master')
@section('title', 'Detail Dokumen: ' . $document->document_type)

@section('content')
<div class="container mx-auto px-6 py-8">
    
    <div class="flex items-center gap-3 mb-6 mt-5">
        <span class="material-symbols-outlined text-4xl text-[#1B3C53]">description</span>
        <h1 class="text-2xl font-bold text-[#1B3C53]">Detail Dokumen</h1>
    </div>

    <!-- Tombol kembali ke Daftar Dokumen -->
    <a href="{{ route('employees.documents.index', $employee) }}" 
       class="inline-flex items-center mb-6 gap-1 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 shadow-md">
       <span class="material-symbols-outlined text-[16px]">arrow_back</span>
       Kembali ke Daftar Dokumen
    </a>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri (1/3): Detail Dokumen -->
        <div class="md:col-span-1 bg-white p-6 shadow-lg rounded-xl">
            <h2 class="text-xl font-bold text-[#1B3C53] mb-4 border-b pb-2">Informasi Dokumen</h2>
            
            <div class="space-y-3 text-sm text-gray-700">
                <p><strong>Pegawai:</strong> {{ $employee->nama_lengkap }}</p>
                <p><strong>Jenis Dokumen:</strong> {{ $document->document_type }}</p>
                <p><strong>Nama File:</strong> {{ $document->filename }}</p>
                <p><strong>Diunggah pada:</strong> {{ \Carbon\Carbon::parse($document->upload_date)->format('d F Y') }}</p>
                
                <p>
                    <strong>Kedaluwarsa:</strong> 
                    @if ($document->expiry_date)
                        <span class="@if(\Carbon\Carbon::parse($document->expiry_date)->isPast()) text-red-600 font-bold @else text-green-600 @endif">
                            {{ \Carbon\Carbon::parse($document->expiry_date)->format('d F Y') }}
                            @if(\Carbon\Carbon::parse($document->expiry_date)->isPast()) (EXPIRED) @endif
                        </span>
                    @else
                        <span>Tidak Ada</span>
                    @endif
                </p>

                <div class="pt-4 border-t mt-4">
                    <!-- Tombol Download -->
                    <a href="{{ asset('storage/documents/' . $document->file_path) }}" target="_blank"
                       class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200 shadow-md mb-2">
                       <span class="material-symbols-outlined text-base">download</span>
                       Unduh File
                    </a>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('employees.documents.destroy', [$employee, $document]) }}" method="POST" class="inline w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200 shadow-md"
                                onclick="return confirm('Yakin mau hapus dokumen ini? File juga akan dihapus dari server.')">
                            <span class="material-symbols-outlined text-base">delete</span>
                            Hapus Dokumen
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <!-- Kolom Kanan (2/3): Preview Dokumen -->
        <div class="md:col-span-2 bg-white p-6 shadow-lg rounded-xl">
            <h2 class="text-xl font-bold text-[#1B3C53] mb-4 border-b pb-2">Pratinjau Dokumen</h2>

            @php
                // menyimpan dalam storage\app\public
                $fileUrl = asset('storage/' . $document->file_path);
                $isPDF = str_ends_with($document->filename, '.pdf');
                $isImage = preg_match('/\.(jpg|jpeg|png)$/i', $document->filename);
            @endphp
            
            @if ($isPDF || $isImage)
                <!-- Preview -->
                <div class="relative w-full" style="height: 700px;">
                    @if ($isPDF)
                        <iframe src="{{ $fileUrl }}" class="w-full h-full border rounded-lg" frameborder="0"></iframe>
                    @elseif ($isImage)
                        <img src="{{ $fileUrl }}" alt="{{ $document->filename }}" class="max-w-full max-h-full object-contain mx-auto border rounded-lg shadow-md" />
                    @endif
                </div>
                
            @else
                <div class="bg-gray-100 p-8 text-center rounded-lg border-2 border-dashed border-gray-300">
                    <span class="material-symbols-outlined text-6xl text-gray-400">file_present</span>
                    <p class="mt-3 text-lg font-medium text-gray-700">Pratinjau tidak didukung.</p>
                    <p class="text-sm text-gray-500">Silakan unduh file untuk melihat.</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection