<?php

namespace App\Models;

use App\Filters\JobFilter;

class Job extends Model
{
    use HasFactory;

    public function scopeFilter(Builder $builder, $request)
    {
        return (new JobFilter($request))->filter($builder);
    }
}