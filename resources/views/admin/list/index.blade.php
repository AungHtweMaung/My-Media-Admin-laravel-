@extends('admin.layouts.app')

@section('title')
    Admin List
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            @if (session('deleteSuccess'))
                <div class="row justify-content-end mt-4">
                    <div class="col-5">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteSuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admin List</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin#listSearch') }}" method="POST">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">

                                <input type="text" name="adminSearchKey"
                                    value="{{ request('adminSearchKey') }}"
                                    class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @if (count($users) != 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $num }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="">
                                            @if ($user->id != Auth::user()->id)
                                                <form action="{{ route('admin#deleteAccount', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>

                                    @php $num++ @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="fs-bold">There is no data.</td>
                                </tr>
                            @endif



                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
