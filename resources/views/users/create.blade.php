<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <section class="mt-5 container bg-white rounded-1 p-5">
        <form class="form form-vertical" method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text"
                               value="{{old('name')}}"
                               id="name"
                               class="form-control form-control-sm @error('name') is-invalid @enderror"
                               name="name"
                               placeholder="Name">
                        @error('name')
                        <div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email"
                               value="{{old('email')}}"
                               id="email"
                               class="form-control form-control-sm @error('email') is-invalid @enderror"
                               name="email"
                               placeholder="email@example.com">
                        @error('email')
                        <div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password"
                               id="password"
                               class="form-control form-control-sm @error('password') is-invalid @enderror"
                               name="password"
                               placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password_confirmation">Password confirmation</label>
                        <input type="password"
                               id="password_confirmation"
                               class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation"
                               placeholder="Password confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback"> {{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" name="image" id="image">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
                    </div>
                    <label>Role</label>
                    <div class="form-group mb-2">
                        <input class="form-check-input" type="radio" name="role" id="learner" value="learner" checked>
                        <label class="form-check-label" for="learner">
                            Learner
                        </label>
                    </div>
                    <div class="form-group mb-2">
                        <input class="form-check-input" type="radio" name="role" id="admin" value="admin">
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-1 mb-1" style="background-color: #2563eb">Create user
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>
