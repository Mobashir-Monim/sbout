@extends('layouts.app')

@section('content')
    <div class="row justify-content-center min-h">
        <div class="col-md-8 my-auto">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4 class="border-bottom mb-0">Login</h4>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Email</h5>
                            </div>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email Address" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-3 my-auto">
                                <h5 class="mb-0">Password</h5>
                            </div>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-9 offset-md-3">
                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-dark">
                                        <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-between">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
