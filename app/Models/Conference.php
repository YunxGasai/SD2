<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'lecturers',
        'date',
        'time',
        'address',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function getIsPastAttribute(): bool
    {
        return $this->date->copy()->startOfDay()->lt(now()->startOfDay());
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_conferences')
            ->withPivot(['registrant_name', 'registrant_email'])
            ->withTimestamps();
    }
}
