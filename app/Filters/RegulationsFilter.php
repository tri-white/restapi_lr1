<?php 

namespace App\Filters\v1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter{
    protected $safeParms = [
        'name' => ['eq'],
        'description'=> ['eq'],
        'minimal_requirements'=>['eq'],
        'gender'=>['eq'],
    ];

    protected $columnMap = [

    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
    ];
}