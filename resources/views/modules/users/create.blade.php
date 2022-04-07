@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create User') }}
                </div>
        
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="post">
                        @csrf
                        <div class="form-group mb-1">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" value="{{old('name')}}"  class="form-control" id="name" name="name" placeholder="{{ __('Name') }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" value="{{old('email')}}" class="form-control" id="email" name="email" placeholder="{{ __('Email') }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" value="{{old('password')}}" class="form-control" id="password" name="password" placeholder="{{ __('Password') }}">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group mb-1">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control"  value="{{old('password_confirmation')}}" id="password_confirmation" name="password_confirmation" placeholder="{{ __('Confirm Password') }}">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group mb-1">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection