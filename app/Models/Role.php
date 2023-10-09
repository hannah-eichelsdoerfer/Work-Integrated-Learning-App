<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(StudentRole::class, 'student_roles');
    }
}
