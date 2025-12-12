<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen">
    @extends('master')
    @section('title', 'Daftar Laporan')
    @section('content')
    <div class="container mx-auto py-2">
    
    <!-- Judul + Filter -->
    <div class="flex flex-wrap items-end justify-between gap-4 mb-6 mt-2">

        <div class="flex items-center gap-3">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/name-tag-woman.png" alt="name-tag-woman"/>
                <h1 class="text-2xl font-bold text-[#1B3C53]">Daftar Laporan</h1>
        </div>

        <form action="{{ route('reports.index') }}" method="GET" class="flex items-end gap-4">

            <!-- Filter Status -->
            <div class="flex">
                <select name="category" class="rounded-lg border-gray-300 shadow-sm p-2.5 focus:border-[#1B3C53] focus:ring-[#1B3C53]">
                    <option value="">Semua</option>
                    <option value="attendance" {{ $categoriesFilter=='attendance' ? 'selected' : '' }}>Attendance</option>
                    <option value="salaries" {{ $categoriesFilter=='salaries' ? 'selected' : '' }}>Salaries</option>
                    <option value="performance" {{ $categoriesFilter=='performance' ? 'selected' : '' }}>Performance</option>
                    <option value="lainnya" {{ $categoriesFilter=='lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <button type="submit" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-white bg-[#1B3C53] rounded-lg hover:bg-[#2d5a7b] transition-colors duration-200 shadow-md h-[42px]">
                <span class="material-symbols-outlined text-[16px]">filter_alt</span>
                Filter
            </button>

            @if(request('category'))
                <a href="{{ route('reports.index') }}" 
                class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors duration-200 shadow-md h-[42px]">
                <span class="material-symbols-outlined text-[16px]">close</span>
                Reset
                </a>
            @endif

        </form>

    </div>


    <!-- Tombol Tambah + Statistik -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <a href="{{ route('reports.create') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-[#1B3C53] to-[#2d5a7b] rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300 shadow-md">
                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                Tambah Pegawai
            </a>

            <!-- Statistik Pegawai -->
            <div class="flex gap-3">

                <div class="px-4 py-2 bg-purple-100 text-purple-700 rounded-lg shadow text-sm font-semibold">
                    Attendance: {{ $total_attendance }}
                </div>

                <div class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg shadow text-sm font-semibold">
                    Salaries: {{ $total_salaries }}
                </div>

                <div class="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg shadow text-sm font-semibold">
                    Performance: {{ $total_performance }}
                </div>

                <div class="px-4 py-2 bg-green-100 text-green-700 rounded-lg shadow text-sm font-semibold">
                    Lainnya: {{ $total_lainnya }}
                </div>

                <div class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg shadow text-sm font-semibold">
                    Total: {{ $total_semua }}
                </div>

            </div>
    </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border border-gray-200 rounded-lg mb-5">
                <thead class="bg-[#456882] text-slate-700">
                    <tr>
                        <th class="px-4 py-2 text-center font-medium text-white">Judul Laporan</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Kategori</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Tanggal Upload</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Notes</th>
                        <th class="px-4 py-2 text-center font-medium text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($reports as $report)
                        <tr class="hover:bg-gray-50 text-slate-600 text-sm">
                            
                            <td class="px-4 py-2">{{ $report->report_title }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if ($report->document_categories == 'attendance') bg-purple-100 text-purple-700
                                    @elseif ($report->document_categories == 'salaries') bg-yellow-100 text-yellow-700
                                    @elseif ($report->document_categories == 'performance') bg-blue-100 text-blue-700
                                    @else bg-green-100 text-green-700 @endif">
                                    {{ ucfirst($report->document_categories) }}
                                </span>
                            </td> 
                            <td class="px-4 py-2 text-sm text-gray-700 text-center">
                                {{ \Carbon\Carbon::parse($report->upload_date)->format('d M Y') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $report->notes ? $report->notes : '-' }}
                            </td>
                            <td class="px-4 py-2 text-center space-x-1">
                                <div class="flex justify-center items-center gap-1">
                                    <a href="{{ route('reports.show', $report->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-md text-blue-600 hover:bg-blue-100 hover:shadow-sm transition-all duration-200"
                                       title="Detail">
                                        <span class="material-symbols-outlined text-[10px] font-light">info</span>
                                    </a>
                                    <a href="{{ route('reports.edit', $report->id) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 rounded-md text-amber-600 hover:bg-amber-100 hover:shadow-sm transition-all duration-200"
                                       title="Edit">
                                        <span class="material-symbols-outlined text-[10px] font-light">edit</span>
                                    </a>
                                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-md text-red-600 hover:bg-red-100 hover:shadow-sm transition-all duration-200"
                                                onclick="return confirm('Yakin mau hapus data ini?')"
                                                title="Hapus">
                                            <span class="material-symbols-outlined text-[10px] font-light">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-5 flex justify-center">
            {{ $reports->onEachSide(1)->links('pagination::tailwind') }}
        </div>
        @endsection
    </div>
</body>
</html>