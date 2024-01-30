<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSportsmansRequest extends FormRequest
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
            'name'=>'string|min:0|max:255',
            'email'=>'nullable|email|string|min:0|max:255|unique:sportsmans,email,'.$this->sportsman->id,
            'gender'=>Rule::in(['male','female']),
            'category'=>Rule::in(['tennis','marathon','spear throwing','athletics']),
            'sponsor'=>'nullable|string|min:0|max:255',
        ];
    }
}
