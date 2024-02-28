<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'body' => ['nullable'],
            'user_id' => ['numeric', 'exists:users,id', 'required'],
            'files' => ['nullable']
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge(['user_id' => auth()->user()->id]);
    }
}
