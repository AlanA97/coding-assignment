<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\TestRequest;
use App\Models\Test;
use App\Traits\ImageUpload;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestController extends Controller
{
    use ImageUpload;

    public function index(): View{
        return view('tests.index', ['tests' => Test::paginate(20)]);
    }

    public function create(): View{
        return view('tests.create');
    }

    public function store(TestRequest $request): RedirectResponse{
        $validatedData = $request->except(['image']);

        if($file = $request->file('image')){
            $imagePath = $this->uploads($file, 'images/');
            $validatedData = [
                ...$validatedData,
                'image_path' =>  $imagePath
            ];
        }

        Test::create($validatedData);

        return redirect()->route('tests.index')->with('message', 'Test successfully created!');
    }

    public function edit(Test $test): View{
        return view('tests.edit', ['test' => $test]);
    }

    public function update(Test $test, CourseRequest $request): RedirectResponse{
        $validatedData = $request->except(['image']);

        if($file = $request->file('image')){
            $imagePath = $this->uploads($file, 'images/');
            $validatedData = [
                ...$validatedData,
                'image_path' => $imagePath
            ];
        }

        tap($test)->update($validatedData);

        return redirect()->route('tests.index')->with('message', 'Test successfully updated!');
    }

    public function destroy(Test $test): RedirectResponse{
        try{
            if($test->image_path) {
                Storage::delete($test->image_path);
            }

            $test->delete();


            return redirect()->back()->with('message', 'Test successfully deleted!');
        } catch(QueryException $queryException){
            return back()->with('error', $queryException->getMessage());
        }
    }
}
