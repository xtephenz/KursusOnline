<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $dates = ['submit_date'];

    protected $fillable = [
        'file_name',
        'submit_date',
        'attempt_number',
        'status',
        'score',
        'assignment_id',
        'student_id'
    ];

    protected function casts() : array
    {
        return [
            'submit_date' => 'date: j F Y',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
