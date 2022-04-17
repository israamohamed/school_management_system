@extends('layouts.app')

@section('content')


    <div class="accountbg"></div>
    <div class="wrapper-page">
        <div class="card">

            <div class="card-body">
                <h3 class="text-center mt-0 mb-3">
                    <a href="#" class="logo"><img src="{{asset('dashboard/assets/images/logo-light.png')}}" height="24" alt="logo-img"></a>
                </h3>
                <h5 class="text-center mt-0 text-color"><b>Sign In</b></h5>

                <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-3 mx-3">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="col-12">
                            <input name="email" class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" required  placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-12">
                            <input name = "password" class="form-control @error('password') is-invalid @enderror" type="password" required="" placeholder="Password">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <input name="remember"  id="checkbox-signup" type="checkbox" checked="" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup" class="text-color">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-3">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light w-100" type="submit">
                                Log In</button>
                        </div>
                    </div>

                    <div class="form-group row mt-4 mb-0">
                        <div class="col-sm-7">
                            <a href="{{ route('password.request') }}" class="text-color">
                                <i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                        </div>       
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
