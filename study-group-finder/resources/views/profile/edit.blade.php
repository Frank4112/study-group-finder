@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Your Profile</h1>
@stop

@section('content')
    <div class="row">

        {{-- Left: basic info --}}
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-5x text-muted"></i>
                    </div>

                    <h3 class="profile-username text-center">
                        {{ auth()->user()->name }}
                    </h3>

                    <p class="text-muted text-center">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Right: edit form --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile Information</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name"
                                   name="name"
                                   type="text"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   required>
                            @error('name')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email"
                                   name="email"
                                   type="email"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required>
                            @error('email')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            {{-- Change Password Card --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password"
                                   type="password"
                                   name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   required>
                            @error('current_password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                            @error('password')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-warning">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop
