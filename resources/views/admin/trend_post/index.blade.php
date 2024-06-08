@extends('admin.layouts.app')

@section('title')
    Trend post
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="">Trend Posts</h4>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Post Title</th>
                                <th>Image</th>
                                <th>View Count</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post['trend_post_id'] }}</td>
                                    <td>{{ $post['title'] }}</td>
                                    <td>
                                        @if (!empty($post->image))
                                            <img width="100px" src="{{ asset('storage/postImage/' . $post->image) }}"
                                                alt="image">
                                        @else
                                            <img width="100px" src="{{ asset('storage/default-image/defaultImage.png') }}"
                                                alt="image">
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-eye mt-3"><span
                                                class="ml-1">{{ $post['post_view_count'] }}</span></i>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin#trend-posts-details', $post['trend_post_id']) }}"
                                            class="btn btn-sm btn-dark text-white">
                                            <i class="fas fa-info mx-2"></i>
                                        </a>
                                        {{-- <button class="btn btn-sm btn-dark text-white"><i
                                                class="fas fa-info mx-2"></i></button> --}}

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>


                </div>



                <!-- /.card-body -->
            </div>
            <div class="d-flex justify-content-end">
                {{-- {{ $posts->links() }} --}}
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
