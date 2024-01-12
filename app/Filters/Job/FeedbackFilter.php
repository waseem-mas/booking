<?php

// BookingFilter.php


namespace App\Filters;
use Illuminate\Support\Facades\DB;

class FeedbackFilter
{
    public function filter($builder, $value){

            return $builder->where('ignore_feedback', '0')
            ->where('rating', '<=', '3');
    }
}
