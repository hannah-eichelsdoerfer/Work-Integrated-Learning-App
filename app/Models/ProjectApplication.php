<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectApplication extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'student_id', 'justification'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function getStudentNameAttribute(): string
    {
        return $this->student->user->name;
    }

    public function getCreatedAtAttribute($value): string
    {
        return date('d/m/Y', strtotime($value));
    }
}
