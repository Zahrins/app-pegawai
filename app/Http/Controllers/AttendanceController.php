<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $filterDate = $request->input('filter_date');

        $query = Attendance::with('karyawan');

        if ($filterDate) {
            $query->whereDate('tanggal', $filterDate);
        }

        $query->orderBy('tanggal', 'desc')->orderBy('waktu_masuk', 'asc');

        // Pagination hasil filter
        $attendance_list = $query->paginate(6)->appends($request->query());

        // Hitung total berdasarkan status (mengikuti filter)
        $total_hadir = $query->clone()->where('status_absensi', 'hadir')->count();
        $total_izin = $query->clone()->where('status_absensi', 'izin')->count();
        $total_sakit = $query->clone()->where('status_absensi', 'sakit')->count();
        $total_alpha = $query->clone()->where('status_absensi', 'alpha')->count();

        return view('attendance.index', compact(
            'attendance_list',
            'total_hadir',
            'total_izin',
            'total_sakit',
            'total_alpha'
        ));
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