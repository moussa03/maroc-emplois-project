
@extends('job_board_layout.app')
@section('content')
<div class="container-fluid d-flex form-container ">
        <div class="card col-5 col-sm-5 col-md-5 col-lg-5">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                <form method="POST" action="{{route('job_seeker.email')}}">
                     @csrf
               <div class="wrap">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                <input type="submit" value="Send reset link email" class="login-input">
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
    </div>
 @endsection
