<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'instructions',
        'due_date',
        'max_points',
        'submission_type'
    ];

    protected $casts = [
        'due_date' => 'datetime'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function isOverdue()
    {
        return $this->due_date->isPast();
    }
}

