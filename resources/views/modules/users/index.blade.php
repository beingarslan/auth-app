@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Users') }}
                </div>

                <div class="card-body">
                    <!-- create user button -->
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">{{ __('Create') }}</a>
                    <!-- create user button end -->

                    @livewire('user.user-list')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection