<?php 

namespace App\Filters\v1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter{
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