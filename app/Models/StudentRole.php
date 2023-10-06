<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentRole extends Pivot
{
    // protected $table = 'student_role';
    protected $fillable = ['student_id', 'role_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
