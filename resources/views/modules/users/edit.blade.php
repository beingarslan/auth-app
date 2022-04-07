@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit User') }}
                </div>

                <div class="card-body">
                    <form action="{{route('users.update')}}" method="post" class="">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group mb-1">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" value="{{old('name', $user->name)}}" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}">
                        </div>
                        <div class="form-group mb-1">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" value="{{old('email', $user->email)}}" class="form-control" id="email" name="email" placeholder="{{ __('Email') }}">
                        </div>
                        <div class="form-group mb-1">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection