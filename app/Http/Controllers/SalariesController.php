<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee; 
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salary::with('karyawan')->latest()->paginate(8);
        return view('salaries.index', compact('salaries'));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all(); 
        
        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10', 
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $isDuplicate = Salary::where('karyawan_id', $validatedData['karyawan_id'])
                             ->where('bulan', $validatedData['bulan'])
                             ->exists();

        if ($isDuplicate) {
            return redirect()->back()->withInput()->withErrors([
                'bulan' => 'Gaji untuk karyawan ini pada bulan ' . $validatedData['bulan'] . ' sudah tercatat.'
            ]);
        }

        $gaji_pokok = $validatedData['gaji_pokok'];
        $tunjangan = $validatedData['tunjangan'] ?? 0;
        $potongan = $validatedData['potongan'] ?? 0;
        
        $total_gaji = $gaji_pokok + $tunjangan - $potongan;

        $dataToCreate = array_merge($validatedData, [
            'total_gaji' => $total_gaji
        ]);

        Salary::create($dataToCreate);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        $salary = Salary::with('karyawan.position')->find($salary->id);
        
        return view('salaries.show', compact('salary'));
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

   /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $validatedData = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $isDuplicate = Salary::where('karyawan_id', $validatedData['karyawan_id'])
                             ->where('bulan', $validatedData['bulan'])
                             ->where('id', '!=', $salary->id)
                             ->exists();

        if ($isDuplicate) {
            return redirect()->back()->withInput()->withErrors([
                'bulan' => 'Gaji untuk karyawan ini pada bulan ' . $validatedData['bulan'] . ' sudah tercatat pada data lain.'
            ]);
        }

        $gaji_pokok = $validatedData['gaji_pokok'];
        $tunjangan = $validatedData['tunjangan'] ?? 0;
        $potongan = $validatedData['potongan'] ?? 0;
        
        $total_gaji = $gaji_pokok + $tunjangan - $potongan;

        $dataToUpdate = array_merge($validatedData, [
            'total_gaji' => $total_gaji
        ]);
        
        $salary->update($dataToUpdate);

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil diperbarui.'); 
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $salary = Salary::findOrFail($id);
        $salary->delete();

        return redirect()->route('salaries.index')->with('success', 'Data gaji berhasil dihapus.');
    }
}
