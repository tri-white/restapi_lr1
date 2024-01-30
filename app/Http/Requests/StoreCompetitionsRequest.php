<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreCompetitionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'string|required|max:255|min:0',
            'event_date'=>'required|date',
            'event_location'=>'required|string|min:0|max:255',
            'prize_pool'=>'required|integer|min:0',
            'sports_type'=>'required|'.Rule::in(['100m sprint','3km run', 'spear throwing','football','tennis'])
        ];
    }
}
