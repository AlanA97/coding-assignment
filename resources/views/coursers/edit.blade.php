<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <section class="mt-5 container bg-white rounded-1 p-5">
        <form class="form form-vertical" method="POST" action="{{route('courses.update', ['course' => $course->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-body">
                <div class="row">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text"
                               value="{{old('name', $course->name)}}"
                               id="name"
                               class="form-control form-control-sm @error('name') is-invalid @enderror"
                               name="name"
                               placeholder="Name">
                        @error('name')
                        <div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file mb-2" name="image" id="image">
                        @if($course->image_path)
                            <img src="{{@App::make('url')->to('/').'/'. $course->image_path }}" style="height: 100px;width:100px;"  alt=""/>
                        @endif
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{old('description', $course->description)}}</textarea>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" style="background-color: #2563eb">Update course
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>
