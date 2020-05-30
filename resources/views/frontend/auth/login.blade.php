@extends('frontend.layouts.app')

@section('content')
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body row justify-content-center">
                    <div class="col-md-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                    </div>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="{{ __('Username') }}">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-key"></i></div>
                                    </div>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="text-center text-white col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="btn-group col px-0 mx-0 mb-0 row" role="group">
                            <div class="col-lg-6 px-0 col-12">
                                {{Form::open(['route' => 'login'])}}
                                {{Form::hidden('username', config('account.sample.user.username'))}}
                                {{Form::hidden('password', config('account.sample.user.password'))}}
                                {{Form::submit(__('Login With Sample Account'), ['class' => 'btn btn-link px-0', 'dusk' => 'sampleLoginBtn'])}}
                            </div>
                            <div class="col-lg-6 col-12 px-0 text-left text-lg-right">
                                <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection