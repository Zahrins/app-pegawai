<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_title',
        'document_categories',
        'notes',
        'upload_file', 
        'upload_date',
    ];

}
