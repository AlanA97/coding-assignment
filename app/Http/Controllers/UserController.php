<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Traits\ImageUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller{

    use ImageUpload;

    public function index(): View{
        return view('users.index', ['users' => User::paginate(20)]);
    }

    public function create(): View{
        return view('users.create');
    }

    public function store(CreateUserRequest $request): RedirectResponse{
        $validatedData = $request->except(['image', 'password']);

        if($file = $request->file('image')){
            $imagePath = $this->uploads($file, 'images/');
            $validatedData = [
                ...$validatedData,
                'image_path' => $imagePath
            ];
        }

        User::create([
            ...$validatedData,
            'password' => Hash::make($request->safe()['password']),
            'email_verified_at' => Carbon::now()
        ]);

        return redirect()->route('users.index')->with('message', 'User successfully created!');
    }

    public function edit(User $user): View{
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user, UpdateUserRequest $request): RedirectResponse{
        $validatedData = $request->except(['image', 'password']);

        if($file = $request->file('image')){
            $imagePath = $this->uploads($file, 'images/');
            $validatedData = [
                ...$validatedData,
                'image_path' => $imagePath ?? null
            ];
        }

        if($request->safe()['password']){
            $validatedData = [
                ...$validatedData,
                'password' => Hash::make($request->safe()['password']),
            ];
        }

        tap($user)->update($validatedData);

        return redirect()->route('users.index')->with('message', 'User successfully updated!');
    }

    public function destroy(User $user): RedirectResponse{
        try{
            if(Storage::delete($user->image_path)){
                $user->delete();
            }

            return redirect()->back()->with('message', 'User successfully deleted!');
        } catch(QueryException $queryException){
            return back()->with('error', $queryException->getMessage());
        }
    }
}
