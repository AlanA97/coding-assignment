<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseRequest;
use App\Models\Course;
use App\Traits\Media;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CourseController extends Controller
{
    use Media;

    public function index(): View{
        return view('coursers.index', ['courses' => Course::paginate(20)]);
    }

    public function create(): View{
        return view('coursers.create');
    }

    public function store(CourseRequest $request): RedirectResponse{
        $validatedData = $request->except(['image']);

        if($file = $request->file('image')){
            $imagePath = $this->uploadImage(file: $file, path: 'images/course/');
            $validatedData = [
                ...$validatedData,
                'image_path' =>  $imagePath
            ];
        }

        Course::create($validatedData);

        return redirect()->route('courses.index')->with('message', 'Course successfully created!');
    }

    public function edit(Course $course): View{
        return view('coursers.edit', ['course' => $course]);
    }

    public function update(Course $course, CourseRequest $request): RedirectResponse{
        $validatedData = $request->except(['image']);

        if($file = $request->file('image')){
            $imagePath = $this->uploadImage(file: $file, path: 'images/course/');
            $validatedData = [
                ...$validatedData,
                'image_path' => $imagePath
            ];
        }

        tap($course)->update($validatedData);

        return redirect()->route('courses.index')->with('message', 'Course successfully updated!');
    }

    public function destroy(Course $course): RedirectResponse{
        try{
            if($course->image_path) {
                Storage::delete($course->image_path);
            }

            $course->delete();


            return redirect()->back()->with('message', 'Course successfully deleted!');
        } catch(QueryException $queryException){
            return back()->with('error', $queryException->getMessage());
        }
    }
}
