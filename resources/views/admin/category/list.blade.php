@extends('admin.layouts.app')

@section('title')
    Category
@endsection

@section('content')
    <div class="row ">
        <div class="col-4 my-4 offset-1">
            <h3 class="text-center mb-2">Create Category</h2>
                <form method="post" action="{{ route('admin#createCategory') }}">
                    @csrf
                    <div class="form-group row mt-3">
                        <label for="inputTitle" class="col-11 col-form-label">Name *</label>
                        <div class="col-11">
                            <input type="text" name="categoryTitle" value="{{ old('categoryTitle') }}"
                                class="form-control form-control-lg @error('categoryTitle') is-invalid @enderror"
                                id="inputTitle" placeholder="Title">
                            @error('categoryTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                    <label for="inputDescription" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-8">
                        <textarea name="categoryDescription" class="form-control" id="" cols="30" rows="7"></textarea>
                        @error('categoryDescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}
                    <div class="row ">
                        <div class="col-sm-11 d-flex justify-content-end">
                            <button class="btn btn-primary px-4" type="submit">Create</button>
                        </div>
                    </div>
                </form>
        </div>
        <div class="col-7 my-5">
            @if (session('deleteSuccess'))
                <div class="row justify-content-end">
                    <div class="col-6">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('deleteSuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('updateSuccess'))
                <div class="row justify-content-end">
                    <div class="col-6">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Category Page</h3>

                    <div class="card-tools">
                        <form action="{{ route('admin#searchCategory') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" value="{{ request('categorySearch') }}" name="categorySearch" class="form-control float-right"
                                    placeholder="Search">

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
                                <th>ID</th>
                                <th>Title</th>
                                <th>Created at</th>
                                {{-- <th>Address</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($categories as $c)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $c['title'] }}</td>
                                    <td>{{ $c->created_at }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin#editCategory', $c->id) }}"><button class="btn btn-sm bg-dark text-white" style="margin-right: 10px;"><i
                                                class="fas fa-edit"></i></button></a>

                                        <form action="{{ route('admin#deleteCategory', $c->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                <?php $num++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
