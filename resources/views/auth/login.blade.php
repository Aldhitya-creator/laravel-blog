@extends('layouts.app')
@section('title','login')

@section('content')
<div class="card shadow-lg">
        <div class="card-body p-5">
            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-floating mb-3">
                    <input class="form-control" id="email" type="email"class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder=" " />
                    <label for="email">Email address</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder=" " />
                    <label for="password">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"  value="{{ old('remember') ? 'checked' : '' }}" />
                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                @endif
                    <button type="submit" class="btn btn-primary" href="{{ route('login') }}">Login</button>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('register') }}">Need an account? Sign up!</a></div>
        </div>
    </div>
</div>

@endsection
