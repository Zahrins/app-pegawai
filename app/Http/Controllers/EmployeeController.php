<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statusFilter = $request->input('status');

        // Query dasar
        $query = Employee::with(['department', 'position'])->latest();

        // Jika ada filter status
        if ($statusFilter == 'aktif') {
            $query->where('status', 'aktif');
        } elseif ($statusFilter == 'nonaktif') {
            $query->where('status', 'nonaktif');
        }

        // Pagination hasil filter
        $employees = $query->paginate(5)->appends($request->query());

        // Statistik (mengikuti filter)
        $total_aktif = Employee::where('status', 'aktif')->count();
        $total_nonaktif = Employee::where('status', 'nonaktif')->count();
        $total_semua = Employee::count();

        return view('employees.index', compact(
            'employees',
            'total_aktif',
            'total_nonaktif',
            'total_semua',
            'statusFilter'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua data departemen dan jabatan untuk dropdown
        $departments = Department::all();
        $positions = Position::all();

        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department_id' => 'required|exists:departments,id', 
            'position_id'    => 'required|exists:positions,id', 
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:15',
        ]);

        Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position'])->find($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::find($id); 
        $departments = Department::all();
        $positions = Position::all();
        
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department_id' => 'required|exists:departments,id', 
            'position_id'    => 'required|exists:positions,id', 
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:15',
        ]);
        
        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'department_id',
            'position_id',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
        ]));
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id); 
        $employee->delete();
        
        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil dihapus');
    }
}
