<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'contact_name', 'contact_email', 'description', 'num_students_needed', 'trimester', 'year', 'industry_partner_id'];

    public function industryPartner(): BelongsTo
    {
        return $this->belongsTo(IndustryPartner::class);
    }

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class);
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function getCreatedAtAttribute($value): string
    {
        return date('d/m/Y', strtotime($value));
    }

    public function previewImage()
    {
        return $this->projectFiles()->where('file_type', '!=', 'pdf')->first();
    }

    public function students()
    {
        // all students who have applied for this project with a status of 'accepted'
        return $this->belongsToMany(Student::class, 'project_applications')->wherePivot('status', 'accepted');
    }
}
