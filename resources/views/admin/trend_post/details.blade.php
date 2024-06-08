@extends('admin.layouts.app')

@section('title')
    {{ $trend_post['title'] }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-7 my-5">
            <span><a href="{{ route('admin#trend-post') }}">
                    <i class="fas fa-arrow-left text-dark" style="font-size: 20px;"></i></a></span>
            <div class="text-center ">
                @if (!empty($trend_post->image))
                    <img width="75%" src="{{ asset('storage/postImage/' . $trend_post->image) }}" alt="image">
                @else
                    <img width="75%" src="{{ asset('storage/default-image/defaultImage.png') }}" alt="image">
                @endif

            </div>
            <h3 class="my-3 text-center">{{ $trend_post->title }}</h3>
            <p style="text-indent: 50px; font-size: 20px;" class="text-justify">
                {{ $trend_post->description }}

            </p>
        </div>
    </div>
@endsection
