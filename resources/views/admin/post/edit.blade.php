@extends('admin.layouts.app')

@section('title')
    Edit Post
@endsection

@section('content')
    <div class="row">
        <div class="col-4 my-4 offset-1">
            <h3 class="text-center mb-2">Edit Post</h2>
                <form method="post" action="{{ route('admin#updatePost', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mt-3">
                        <label for="inputTitle" class="col-11 col-form-label">Name *</label>
                        <div class="col-11">
                            <input type="text" name="postTitle" value="{{ old('postTitle', $post->title) }}"
                                class="form-control @error('postTitle') is-invalid @enderror" id="inputTitle"
                                placeholder="Title">
                            @error('postTitle')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDescription" class="col-11 col-form-label">Description *</label>
                        <div class="col-11">
                            <textarea name="postDescription" class="form-control" id="" cols="30" rows="7">{{ old('postDescription', $post->description) }}</textarea>
                            @error('postDescription')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label for="inputImage" class="col-11 col-form-label">Image</label>

                        <div class="col-11">
                            <img width="75%" height="75%"
                                @if ($post->image != null) src="{{ asset('storage/postImage/' . $post->image) }}"
                                @else src="{{ asset('storage/default-image/defaultImage.png') }}" @endif
                                alt="">
                            <input type="file" name="postImage" value=""
                                class="form-control form-control-lg mt-3 @error('postImage') is-invalid @enderror"
                                id="inputImage" placeholder="Title">
                            @error('postImage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <label class="col-11 col-form-label">Category Name *</label>
                        <div class="col-11">
                            <select name="postCategoryId" id="" class="form-control">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('postCategoryId', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('postCategoryId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-11 d-flex justify-content-end">
                            <button class="btn btn-primary px-4" type="submit">Update</button>
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
                                <input type="text" value="{{ request('categorySearch') }}" name="categorySearch"
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
                                <th>Post Id</th>
                                <th>Title</th>
                                <th>Image</th>
                                {{-- <th>Address</th> --}}
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            ?>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $num }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        @if (!empty($post->image))
                                            <img width="100px" src="{{ asset('storage/postImage/' . $post->image) }}"
                                                alt="image">
                                        @else
                                            <img width="100px" src="{{ asset('storage/default-image/defaultImage.png') }}"
                                                alt="image">
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin#editPost', $post->id) }}"><button
                                                class="btn btn-sm bg-dark text-white" style="margin-right: 10px;"><i
                                                    class="fas fa-edit"></i></button></a>

                                        <form action="{{ route('admin#deletePost', $post->id) }}" method="POST">
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
