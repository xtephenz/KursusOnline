<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    use HasFactory;

    protected $dates = ['start_date', 'due_date'];

    protected $fillable = [
        'title',
        'file_name',
        'start_date',
        'due_date',
        'attempts',
        'status',
        'course_id'
    ];

    protected function casts() : array
    {
        return [
            'start_date' => 'date: j F Y',
            'due_date' => 'date: j F Y'
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class, 'assignment_id');
    }
}
