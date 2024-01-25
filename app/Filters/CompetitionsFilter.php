<?php 

namespace App\Filters;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CompetitionsFilter extends ApiFilter{
    protected $safeParms = [
        'name' => ['eq'],
        'event_date'=> ['eq','gt','lt'],
        'event_location'=>['eq'],
        'prize_pool'=>['eq'],
        'sports_type'=>['eq'],
    ];

    protected $columnMap = [
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
    ];
}