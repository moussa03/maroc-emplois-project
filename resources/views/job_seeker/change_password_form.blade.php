
@extends('job_board_layout.app')
@section('content')

@php
  $boringLanguage = 'fr';
$translator = \Carbon\Translator::get($boringLanguage);

$date1 = Carbon\Carbon::now();
$translator->setTranslations([
    'after' => function ($time) {
        return 'publié'.' '.''.$time.' avant';
    },
]);
@endphp
<div class="container-fluid">
    <div class="row">
        @component('layouts.components.side_navbar')
        @slot('dashboard')
        <a href="{{route('job_seeker/dashboard',$job_seeker_id)}}">
            <li class="p-3 {{ Request::segment(2) === 'dashboard'? 'active' : null }}"><span><i class="fa fa-th-large"></i></span>   tableau de bord</li>
        @endslot
            @slot('profile')

            <a class="dropdown-item p-0" href="{{route('job_seeker/profile',$job_seeker_id)}}">
                <li class="p-3"> <span><i class="fa fa-user"></i></span> profile</li>

                </a>
            @endslot
                @slot('pup_anonnce')
                <a class="dropdown-item p-0" href="{{route('job_seeker/resume',$job_seeker_id)}}">
                    <li class="p-3"> <span><i class="far fa-calendar-alt"></i>
                        </span> publier mon resumé
                    </li>
                </a>
            @endslot
                @slot('jobs')
                <a class="dropdown-item p-0" href="{{route('job_seeker/applied_jobs',$job_seeker_id)}}">
                    <li class="p-3"> <span><i class="far fa-clone"></i>
                        </span> Mes candidatures</li>
                </a>
                @endslot
                @slot('single_page')
                <a class="dropdown-item p-0" href="{{route('job_seeker/show_resumé',['username' => $username, 'id' => $job_seeker_id])}}">
                    <li class="p-3">
                        <span><i class="fas fa-receipt"></i>
                        </span> mon resumé </li>
                </a>
                @endslot
                @slot('username')
                {{$job_seeker->username}}
                @endslot
                @slot('poste')
                {{$job_seeker->current_job}}
                @endslot
                @slot('profile_picture')
                {{$job_seeker->profile_picture}}
                @endslot
                @slot('change_password')
                <a class="dropdown-item p-0 " href="{{route('job_seeker/change_password',$job_seeker_id)}}">

                    <li class="p-3 {{ Request::segment(2) === 'change_password'? 'active' : null }}">
                        <span><i class="fas fa-unlock-alt"></i>
                        </span> changer mot de passe </li>
                </a>
                @endslot
                @slot('log_out')

                <a class="dropdown-item p-0" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <li class="p-3">
                        <span><i class="fas fa-sign-out-alt"></i>
                        </span> déconnexion </li>
                </a>

                <form id="logout-form" action="{{ route('job_seeker/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>


               @endslot
                @slot('delete_profile')
                <li class="p-3 text-danger" id="myBtn" class="dropdown-item">
                 <span><i class="fas fa-trash"></i>
                 </span>  supprimer le compte </li>
                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span>voulez vraiment supprimer votre compte</span>
                    <div class=" d-flex justify-content-center align-items-center">
                    <form method="POST" action="{{route('delete/job_seeker',$job_seeker->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-danger mr-2">oui</button>
                        <button type="button" class=" btn btn-light close ">non</button>
                    </form>

                    </div>
                </div>
                </div>
                @endslot
                @endcomponent
                <div class="card col-5 col-sm-5 col-md-5 col-lg-5 password_card">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
                    <form method="POST" action="{{ route('job_seeker/update_password',$job_seeker_id) }}">
                         @csrf
                   <div class="wrap">


                    <input type="text" placeholder="nouveau mot de passe" class="login-input @error('password') is-invalid @enderror" name="password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" placeholder="confirmer mot de passe " class="login-input" name="password_confirmation">
                    <input type="submit" value="mise à jour le mot de passe" class="login-input">
                    </div>
                </div>
                @component('layouts.components.footer')

                 @endcomponent
                @endsection
