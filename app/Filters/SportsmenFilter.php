<?php 

namespace App\Filters\v1;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomersFilter extends ApiFilter{
    protected $safeParms = [
        'name' => ['eq'],
        'email'=> ['eq'],
        'gender'=>['eq'],
        'category'=>['eq'],
        'sponsor'=>['eq'],
    ];

    protected $columnMap = [
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
    ];
}