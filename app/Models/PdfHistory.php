<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdfHistory extends Model
{
    protected $fillable = [
        'file_path',
        'file_name',
        'pdf_type',
        'level_id',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
