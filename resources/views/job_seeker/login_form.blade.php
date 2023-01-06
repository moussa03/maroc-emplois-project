@extends('job_board_layout.app')
@section('content')
<ul class="text-center">
    {{-- @foreach ($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach --}}
</ul>
 <div class="card col-5 col-sm-5 col-md-5 col-lg-5">
            <form method="POST" action="{{ route('job_seeker.login') }}">
                 @csrf
           <div class="wrap">

           <input name="email" type="text" placeholder="Username" class="form-control login-input @error('email') is-invalid @enderror" value="{{ old('email') }}"/>
                                   @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
            <input name="password" type="text" placeholder="Password" class="form-control login-input @error('password') is-invalid @enderror" />

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            <input type="submit" value="Sign In" class="login-input">

            <div class="register-modal">
                <span><a href="{{route('register/job_seeker')}}">inscrit toi</a></span>
                <span><a href="{{route('job_seeker/request')}}">Forgotten Password</a></span>
            </div>
            {{-- <div class="separator">
                <span class="divider">or</span>
                <span class="sep"></span>
            </div>
            <div class="social-login">
                <p class="social-button">
                    <a class="facebook-before"><span class="fontawesome-facebook"></span></a>
                    <button class="facebook">Login Using Facbook</button>
                </p>
                <p class="social-button">
                    <a class="twitter-before"><span class="fontawesome-twitter"></span></a>
                    <button class="twitter">Login Using Twitter</button>
                </p>
            </div> --}}
        </div>
    </form>

    </div>
    @endsection
