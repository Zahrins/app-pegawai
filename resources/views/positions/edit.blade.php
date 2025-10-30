<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Jabatan</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-1/2 justify-center bg-[#F0F0F0] rounded-3xl p-10 shadow-2xl border border-slate-300">
        <h2 class="text-2xl font-bold text-center text-[#1B3C53] mb-2">Edit Data Jabatan</h2>
        
        <form action="{{ route('positions.update', $position->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table class="flex justify-center mt-15">
                <tr>
                    <td class="pr-20">Nama Jabatan</td>
                    <td><input type="text" class="w-70 mt-1 block rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none"
                                name="nama_jabatan" value="{{ old('nama_jabatan', $position->nama_jabatan) }}" ></td>
                </tr>
                <tr>
                    <td class="pr-20">Gaji Pokok</td>
                    <td><input type="text" class="w-70 mt-1 block rounded-lg border border-slate-300 p-2 focus:ring-1 focus:ring-[#456882] focus:outline-none"
                                name="gaji_pokok" value="{{ old('gaji_pokok', $position->gaji_pokok) }}" ></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right">
                        <a href="{{ route('positions.index') }}" type="submit"
                            class="px-5 py-2 mr-4 rounded-lg bg-slate-500 text-white font-semibold hover:bg-[#142836] shadow-md transition duration-200">
                            Kembali
                        </a>
                        <button type="submit" class="px-5 py-2 mt-10 rounded-lg bg-slate-600 text-white font-semibold hover:bg-slate-700 shadow-md">Update</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>