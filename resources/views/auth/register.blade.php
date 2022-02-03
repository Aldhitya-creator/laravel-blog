@extends('layouts.app')
@section('title','register')

@section('content')
<div class="card shadow-lg">
    <div class="card-body p-4">
        <h1 class="fs-4 card-title fw-bold mb-4">Register</h1>
        <form method="POST" action="{{ route('register') }}">
                            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-floating mb-3 mb-md-0">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" placeholder= " "/>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                        <label for="name">name</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder=" ">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="email">Email address</label>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder=" ">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder=" ">
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                </div>
            </div>
            <div class="mt-3 mb-0">
                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" >Create Account</button></div>
            </div>
        </form>
        </div>     
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('login') }}">Already have account login!</a></div>
        </div> 
    </div>  
</div>
@endsection
