<?php 

namespace App\Filters;
use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class RegulationsFilter extends ApiFilter{
    protected $safeParms = [
        'name' => ['eq','contains'],
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
        'contains'=>'like',
    ];
}