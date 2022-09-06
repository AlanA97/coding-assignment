<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Courses') }}
            </h2>
            @can('isAdmin')
                <a href="{{route('courses.create')}}">
                    <button type="button" class="btn btn-sm btn-success" style="background-color: green">Add New Course</button>
                </a>
            @endcan
        </div>
    </x-slot>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created at</th>
                            @can('isAdmin')
                                <th scope="col">Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$course->name}}</td>
                                <td>{{$course->description ?? 'No description'}}</td>
                                <td>{{$course->created_at->format('d.m.Y')}}</td>
                                @can('isAdmin')
                                    <td class="d-flex">
                                        <a href="{{route('courses.edit', ['course' => $course->id] )}}">
                                            <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                        </a>
                                        <x-delete-button :route="route('courses.destroy', ['course' => $course->id] )"></x-delete-button>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $courses->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
