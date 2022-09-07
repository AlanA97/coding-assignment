<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array{
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => ['confirmed', 'sometimes', 'min:6', 'nullable'],
            'image' => ['image'],
            'description' => ['max:1000']
        ];
    }
}
