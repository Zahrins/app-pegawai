<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        $documents = $employee->documents()->orderBy('upload_date', 'desc')->get();
        $document_types = ['KTP', 'Ijazah', 'Kontrak Kerja', 'CV', 'Sertifikat', 'Lainnya'];

        return view('employees.documents.index', compact('employee', 'documents', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'document_type' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', 
            'expiry_date' => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $fileName, 'public'); // Simpan di storage/app/public/documents

            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'document_type' => $request->document_type,
                'filename' => $fileName, 
                'file_path' => $path, 
                'upload_date' => Carbon::now()->toDateString(),
                'expiry_date' => $request->expiry_date,
            ]);

            return redirect()->route('employees.documents.index', $employee)
                            ->with('success', 'Dokumen berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah dokumen.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee, EmployeeDocument $document)
    {
        // Pastikan dokumen memang milik pegawai ini (untuk keamanan)
        if ($document->employee_id !== $employee->id) {
            abort(404, 'Dokumen tidak ditemukan untuk pegawai ini.');
        }

        return view('employees.documents.show', compact('employee', 'document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function destroy(Employee $employee, EmployeeDocument $document)
    {
        // Pastikan dokumen memang milik pegawai ini (untuk keamanan)
        if ($document->employee_id !== $employee->id) {
            return redirect()->back()->with('error', 'Dokumen tidak valid.');
        }
        
        // Hapus file fisik dari storage
        Storage::disk('public')->delete($document->file_path);

        // Hapus data dari database
        $document->delete();

        return redirect()->route('employees.documents.index', $employee)->with('success', 'Dokumen berhasil dihapus.');
    }
}