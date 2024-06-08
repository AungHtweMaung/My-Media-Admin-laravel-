@extends('admin.layouts.app')

@section('title')
    Change Password
@endsection

@section('myCss')
<style>
    input[type="password"]::placeholder{
        color: red;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-10 col-md-8 offset-1 offset-md-3 mt-5">
            <div class="row">
                <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <legend class="text-center">Change Password</legend>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                @if (session('changePasswordSuccess'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ session('changePasswordSuccess') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                @endif
                                <form action="{{ route('admin#changePassword') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="oldPassword" class="col-md-4 col-form-label">Old Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="oldPassword" placeholder="@if ($errors->has('oldPassword')) {{ $errors->first('oldPassword') }}
                                            @elseif (session('changePasswordFail')){{ session('changePasswordFail') }}
                                            @endif" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword">
                                            {{-- @error('oldPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-md-4 col-form-label">New Password</label>
                                        <div class="col-md-8">
                                            <input type="password" name="newPassword" placeholder="@error('newPassword') {{ $message }} @enderror" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword">
                                            {{-- @error('newPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-md-4 col-form-label @error('confirmPassword') is-invalid @enderror">ConfirmPassword</label>
                                        <div class="col-md-8">
                                            <input type="password" name="confirmPassword" placeholder="@error('confirmPassword') {{ $message }} @enderror" class="form-control @error('confirmPassword') is-invalid @enderror"
                                                id="confirmPassword">
                                            {{-- @error('confirmPassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>

                                    <div class="form-group row mt-2 justify-content-end">
                                        <button type="submit" class="col-12 col-sm-4 btn bg-dark text-white mr-1">Update</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection
