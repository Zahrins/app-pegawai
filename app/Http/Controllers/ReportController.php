<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
    
    $categoriesFilter = $request->input('category');

    $query = Report::query();

    if ($categoriesFilter) {
        $query->where('document_categories', $categoriesFilter);
    }

    $reports = $query->latest()->paginate(8)->appends($request->query());

    // Statistik data
    $total_attendance  = Report::where('document_categories', 'attendance')->count();
    $total_salaries    = Report::where('document_categories', 'salaries')->count();
    $total_performance = Report::where('document_categories', 'performance')->count();
    $total_lainnya     = Report::where('document_categories', 'Lainnya')->count();
    $total_semua       = Report::count();


    return view('reports.index', compact(
        'reports',
        'categoriesFilter',
        'total_attendance',
        'total_salaries',
        'total_performance',
        'total_lainnya',
        'total_semua',
    ));
    }

    public function create()
    {
        $categories = ['attendance', 'salaries', 'performance', 'Lainnya'];
        return view('reports.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'report_title' => 'required|string|max:100|unique:reports,report_title',
            'document_categories' => 'required|string|max:50',
            'notes' => 'nullable|string|max:500',
            'upload_file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx',
        ]);

        
        $data = $request->only([
            'report_title',
            'document_categories',
            'notes',
        ]);

        $data['notes'] = $data['notes'] ?? null;
        $data['upload_date'] = now();

        
        if ($request->hasFile('upload_file')) {
            $fileName = time() . '_' . $request->file('upload_file')->getClientOriginalName();
            $request->file('upload_file')->storeAs('reports', $fileName, 'public');
            $data['upload_file'] = $fileName;
        }

        Report::create($data);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function edit(string $id)
    {
        $report = Report::findOrFail($id);
        $categories = ['attendance', 'salaries', 'performance', 'Lainnya'];

        return view('reports.edit', compact('report', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'report_title' => 'required|string|max:100|unique:reports,report_title,' . $id,
            'document_categories' => 'required|string|max:50',
            'notes' => 'nullable|string|max:500',
            'upload_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx',
        ]);

        $report = Report::findOrFail($id);

        $data = $request->only([
            'report_title',
            'document_categories',
            'notes',
        ]);

        // Jika ada file baru, upload & update tanggal upload
        if ($request->hasFile('upload_file')) {
            $fileName = time() . '_' . $request->file('upload_file')->getClientOriginalName();
            $request->file('upload_file')->storeAs('reports', $fileName, 'public');
            $data['upload_file'] = $fileName;
            $data['upload_date'] = now();
        }

        $report->update($data);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus');
    }
}
