<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

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
