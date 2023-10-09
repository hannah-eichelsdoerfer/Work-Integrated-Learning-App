<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\StudentRole;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'gpa'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function roles(): HasMany
    {
        return $this->hasMany(StudentRole::class);
    }
    
    public function applications(): HasMany
    {
        return $this->hasMany(ProjectApplication::class);
    }

    public function hasCompletedProfile()
    {
        return !empty($this->gpa) && !empty($this->roles);
    }
    
}
