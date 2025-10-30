<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit Gaji Pegawai</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center overflow-hidden m-10">

    <div class="w-full max-w-lg bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h1 class="text-2xl font-bold text-center text-[#1B3C53] mb-6">Edit Gaji Pegawai</h1>

        <form action="{{ route('salaries.update', $salary->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Gagal Update!</strong>
                    <span class="block sm:inline">Periksa kembali data yang Anda masukkan.</span>
                </div>
            @endif

            {{-- Dropdown Karyawan --}}
            <div>
                <label for="karyawan_id" class="block text-sm font-medium text-slate-700 mb-1">Karyawan</label>
                <select id="karyawan_id" name="karyawan_id"
                    class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                    <option value="">Karyawan</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}"
                            {{ old('karyawan_id', $salary->karyawan_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Bulan Gaji --}}
            <div>
                <label for="bulan" class="block text-sm font-medium text-slate-700">Bulan Gaji (YYYY-MM)</label>
                <input type="month" id="bulan" name="bulan"
                       value="{{ old('bulan', $salary->bulan) }}"
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                @error('bulan')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Gaji Pokok --}}
            <div>
                <label for="gaji_pokok" class="block text-sm font-medium text-slate-700">Gaji Pokok</label>
                <input type="text" id="gaji_pokok" name="gaji_pokok"
                       value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                @error('gaji_pokok')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Tunjangan --}}
            <div>
                <label for="tunjangan" class="block text-sm font-medium text-slate-700">Tunjangan</label>
                <input type="text" id="tunjangan" name="tunjangan"
                       value="{{ old('tunjangan', $salary->tunjangan) }}"
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                @error('tunjangan')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input Potongan --}}
            <div>
                <label for="potongan" class="block text-sm font-medium text-slate-700">Potongan</label>
                <input type="text" id="potongan" name="potongan"
                       value="{{ old('potongan', $salary->potongan) }}"
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none">
                @error('potongan')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Total Gaji (readonly) --}}
            <div>
                <label for="total_gaji_display" class="block text-sm font-medium text-slate-700">Total Gaji (Saat Ini)</label>
                <input type="text" id="total_gaji_display"
                       value="Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}"
                       readonly
                       class="mt-1 block w-full rounded-lg border border-slate-300 p-2 bg-slate-200 font-bold focus:outline-none">
                <p class="text-xs text-slate-500 mt-1">
                    Total gaji akan dihitung ulang setelah data disimpan.
                </p>
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-right pt-4">
                <a href="{{ route('salaries.index') }}"
                   class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
                   Kembali
                </a>
                <button type="submit"
                        class="px-5 py-2 rounded-lg bg-[#1B3C53] text-white font-semibold hover:bg-slate-700 shadow-md">
                    Update Gaji
                </button>
            </div>
        </form>
    </div>

</body>
</html>
