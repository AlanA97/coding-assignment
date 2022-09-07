<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    public function rules(): array{
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', 'min:6'],
            'image' => ['image'],
            'description' => ['max:1000']
        ];
    }
}
