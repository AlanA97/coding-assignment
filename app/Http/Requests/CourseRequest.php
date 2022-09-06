<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function rules(): array{
        return [
            'name' => ['required', 'max:255'],
            'image' => ['image'],
            'description' => ['max:1000']
        ];
    }
}
