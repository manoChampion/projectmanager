<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'label', 'icon', 'area'
    ];

    public function degree() {
        return $this->belongsTo(Degree::class);
    }

    public function ideas() {
        return $this->belongsToMany(Idea::class);
    }

    public function institutions() {
        return $this->belongsToMany(Institution::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
