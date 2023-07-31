<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'violation',
        'violation_date',
        'action',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
