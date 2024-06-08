@extends('admin.layouts.app')

@section('title')
    Profile
@endsection

@section('content')
    <div class="row">
        <div class="col-10 col-sm-8 offset-1 offset-sm-3 my-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <legend class="text-center">User Profile</legend>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @if (session('accountUpdateSuccess'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ session('accountUpdateSuccess') }}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    @endif
                                    <form action="{{ route('admin#updateAccount') }}" method="POST"
                                        class="form-horizontal">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="adminName"
                                                    value="{{ old('adminName', $user->name) }}" class="form-control"
                                                    id="inputName" placeholder="Name">
                                                @error('adminName')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" name="adminEmail"
                                                    value="{{ old('adminEmail', $user->email) }}" class="form-control"
                                                    id="inputEmail" placeholder="Email">
                                                @error('adminEmail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone" class="col-sm-3 col-form-label">Phone</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="adminPhone"
                                                    value="{{ old('adminPhone', $user->phone) }}" class="form-control"
                                                    id="inputPhone" placeholder="09xxxxxxxxx">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputAddress" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-8">
                                                <textarea name="adminAddress" placeholder="Enter address ..." id="inputAddress" class="form-control" cols="30"
                                                    rows="8">{{ old('adminAddress', $user->address) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputGender" class="col-sm-3 col-form-label">Gender</label>
                                            <div class="col-sm-8">
                                                <select name="adminGender" id="" class="form-control">
                                                    {{-- select box ထဲမှာ old value ပြချင်ရင် ခုလိုရေး --}}
                                                    <option value="male"
                                                        {{ old('adminGender', $user->gender == 'male' ? 'selected' : '') }}>
                                                        Male
                                                    </option>
                                                    <option value="female"
                                                        {{ old('adminGender', $user->gender == 'female' ? 'selected' : '') }}>
                                                        Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-8">
                                                <button type="submit"
                                                    class="btn bg-dark text-white py-2 px-3">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="form-group row">
                                        <div class="offset-sm-3 col-sm-8">
                                            <a class="" href="{{ route('admin#changePasswordPage') }}">Change
                                                Password</a>
                                        </div>
                                    </div>
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
