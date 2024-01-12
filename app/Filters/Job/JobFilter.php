<?php



namespace App\Filters\PostJob;


use Illuminate\Database\Eloquent\Builder;
use App\Filters\PostJob\AbstractFilter;

class JobFilter extends AbstractFilter
{
    protected $filters = [
        'feedback' => FeedbackFilter::class,
    ];
}
