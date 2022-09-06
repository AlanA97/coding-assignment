<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{route('users.create')}}">
                <button type="button" class="btn btn-sm btn-success" style="background-color: green">Add New User</button>
            </a>
        </div>
    </x-slot>

    <section class="mt-5">
        <div class="container">
            <div class="row pb-5">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td class="d-flex">
                                    <a href="{{route('users.edit', ['user' => $user->id] )}}">
                                        <button type="button" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                    </a>
                                    <x-delete-button :route="route('users.destroy', ['user' => $user->id] )"></x-delete-button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </section>
</x-app-layout>
