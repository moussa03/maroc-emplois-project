
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
<div class="container-fluid overflow-hidden p-0">
    <div class="row">
        @component('layouts.components.side_navbar')
        @slot('dashboard')
        <a href="{{route('employer/dashboard',$employer_id)}}">
            <li class="p-3"><span><i class="fa fa-th-large"></i></span>   tableau de bord</li>

            @endslot
            @slot('profile')
            <a class="dropdown-item p-0" href="{{route('employer/profile',$employer_id)}}">
                <li class="p-3">
                    <span><i class="fa fa-user"></i>
                    </span>  profile </li>
            </a>
            @endslot
                @slot('pup_anonnce')
                <a class="dropdown-item p-0" href="{{route('register/job_offer',$employer_id)}}">
                    <li class="p-3"> <span><i class="far fa-calendar-alt"></i>
                    </span> publier une annonce</li>
                </a>
                @endslot
                @slot('jobs')
                <a class="dropdown-item p-0" href="{{route('employer/my_jobs',$employer_id)}}">
                    <li class="p-3 {{ Request::segment(3) === 'my_jobs' ? 'active' : null }}"> <span><i class="far fa-clone"></i>
                    </span> mes offres</li>
                </a>
                @endslot
                @slot('single_page')
                <a class="dropdown-item p-0" href="{{route('employer/details',$employer_id)}}">
                    <li class="p-3"> <span><i class="fas fa-receipt"></i>
                    </span>  détails</li>
                 </a>
                @endslot
                @slot('username')
                {{$employer->username}}
                @endslot
                @slot('poste')
                {{-- {{$job_seeker->current_job}} --}}
                @endslot
                @slot('profile_picture')
                {{$employer->profile_picture}}
                @endslot
                @slot('change_password')
                <a class="dropdown-item p-0" href="{{route('employer/change_password',$employer_id)}}">
                    <li class="p-3">
                        <span><i class="fas fa-unlock-alt"></i>
                        </span> changer mot de passe </li>
                </a>
                @endslot
                @slot('log_out')
                <a class="dropdown-item p-0" href="{{ route('employer/logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                     <li class="p-3">
                        <span><i class="fas fa-sign-out-alt"></i>
                        </span> déconexion </li>
                </a>

                <form id="logout-form" action="{{route('employer/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>


               @endslot
                @slot('delete_profile')
                <li class="p-3 text-danger" id="myBtn">
                    <span><i class="fas fa-trash"></i>
                    </span> supprimer mon compte </li>
        <!-- The Modal -->
        <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span>voulez vraiment supprimer votre compte</span>
            <div class=" d-flex justify-content-center align-items-center">
            <form method="POST" action="{{route('delete/employer',$employer_id)}}">
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
            <form method="POST" action="{{ route('employer/update_password',$employer_id) }}">
                 @csrf
           <div class="wrap">
            <input type="text" placeholder="nouveau mot de passe" class="login-input @error('password') is-invalid @enderror" name="password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" placeholder="confirmer le  mot de passe " class="login-input" name="password_confirmation">
            <input type="submit" value="mise & jour  le mot de passe" class="login-input">
            </div>
        </div>
        @component('layouts.components.footer')

         @endcomponent
         <script >
            // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
            </script>
    @endsection
