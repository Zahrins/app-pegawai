<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance_list = Attendance::with('karyawan')->latest()->paginate(15);
        
        return view('attendance.index', compact('attendance_list'));
    }

    public function create()
    {
        $employees = Employee::select('id', 'nama_lengkap')->orderBy('nama_lengkap')->get();
        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];
        
        return view('attendance.create', compact('employees', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        
        // Cek apakah sudah ada absensi untuk karyawan dan tanggal ini
        $exists = Attendance::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Absensi untuk karyawan ini pada tanggal tersebut sudah ada.');
        }

        Attendance::create($request->all());

        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil disimpan.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        $attendance = Attendance::with('karyawan.position')->find($attendance->id);
        
        return view('attendance.show', compact('attendance'));
    }

    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::select('id', 'nama_lengkap')->orderBy('nama_lengkap')->get(); 
        $statuses = ['hadir', 'izin', 'sakit', 'alpha'];
        return view('attendance.edit', compact('attendance', 'employees', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|string',
            'waktu_keluar' => 'nullable|string',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);
        
        $attendance = Attendance::findOrFail($id);

        // Cek apa sudah absen atau belum
        $exists = Attendance::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->where('id', '!=', $id) 
                            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Absensi untuk karyawan ini pada tanggal tersebut sudah ada pada data lain.');
        }

        $attendance->update($request->all());

        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id); 
        $attendance->delete();

        return redirect()->route('attendance.index')->with('success', 'Data absensi berhasil dihapus.');
    }
}