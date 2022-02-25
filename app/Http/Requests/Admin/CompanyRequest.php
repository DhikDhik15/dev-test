<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role->name === Role::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('companies', 'email')->ignore($this->route('company'))],
            'website' => ['required', 'string', 'max:255', 'url'],
            'logo' => [Rule::requiredIf($this->route('company') === null), 'image', 'mimes:png', 'max:2048', 'dimensions:min_width=100,min_height=100'],
        ];
    }
}
