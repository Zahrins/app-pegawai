<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'document_type',
        'filename',
        'file_path',
        'upload_date',
        'expiry_date',
    ];

    // Relasi ke Employee (Dokumen dimiliki oleh satu Karyawan)
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
