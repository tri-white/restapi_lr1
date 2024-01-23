<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSportsmenRequest extends FormRequest
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
            'email'=>'email|string|min:0|max:255|unique:users,email,'.$this->id,
            'gender'=>Rule::in(['male','female']),
            'category'=>Rule::in(['tennis','marathon','spear throwing','athletics']),
            'sponsor'=>'nullable|string|min:0|max:255',
        ];
    }
}
