<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Position;
use App\Models\Attendance;

class Employee extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'email',
        'department_id',
        'position_id',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
    ];

    public function department() {
    return $this->belongsTo(Department::class, 'department_id');
    }

    public function position() {
        return $this->belongsTo(Position::class, 'position_id');
    }
}

