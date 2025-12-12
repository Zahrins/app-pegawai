<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jabatan',
        'gaji_pokok',
    ];

    public function employees() {
        return $this->hasMany(Employee::class, 'jabatan_id');
    }
}
