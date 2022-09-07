<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    public function rules(): array{
        return [
            'name' => ['required', 'max:255'],
            'image' => ['image'],
            'description' => ['max:1000']
        ];
    }
}
