
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
@if ($updated = Session::get('updated'))
<div class="alert alert-success alert-block mb-0 text-center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $updated }}</strong>
</div>
@endif
<div class="container-fluid pl-0">
    <div class="row">
        @component('layouts.components.side_navbar')
        @slot('dashboard')
        <a href="{{route('employer/dashboard',$employer_id)}}">
            <li class="p-3 {{ Request::segment(2) === 'dashboard'? 'active' : null }}"><span><i class="fa fa-th-large"></i></span>   tableau de bord</li>

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
                <li class="p-3"> <span><i class="far fa-clone"></i>
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
                        </span> déconnexion </li>
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
                <div class="col-lg-9 col-xl-9 profile-content">
                    <div>
                        <span class="page-title font">
                            <h2 class="font-weight-bold"> tableau de bord</h2>
                            {{-- <div class="d-lg-none d-xl-none">
                                @component('layouts.components.navbar_small_device')
                                @endcomponent
                            </div> --}}
                        </span>
                    </div>
                    <div class="profile-form mt-5 container">
                        <div class="profile-logo">
                        </div>
                        <div class="dashboard-element-shortcode ">
                            <div class="box-element-shortcode mt-5">
                                <div class="row">
                                    <div class="box-post-job col-sm-6 col-lg-4 col-xl-4">
                                        <div class="box-icon">
                                            <img src="{{asset('public/img/portfolio.png')}}" alt="">
                                        </div>
                                        <div class="box-content">
                                        <h3 class="font-weight-bold">{{$employer->job_offer->count()}}</h3>
                                            <span>postes ouverts</span>
                                        </div>
                                    </div>
                                    <div class="box-post-job col-sm-6 col-lg-4 col-xl-4">
                                        <div class="box-icon applicant-job">
                                            <img src="{{asset('public/img/resume.png')}}" alt="">
                                        </div>
                                        <div class="box-content applicant-job">
                                        <h3 class="font-weight-bold"></h3>
                                            <span>Applicants</span>
                                        </div>
                                    </div>
                                    {{-- <div class="box-post-job col-sm-6 col-lg-3 col-xl-3">
                                        <div class="box-icon review">
                                            <img src="{{asset('public/img/chat.png')}}" alt="">
                                        </div>
                                        <div class="box-content review">
                                            <h3 class="font-weight-bold">3</h3>
                                            <span>reviews</span>
                                        </div>
                                    </div> --}}
                                    <div class="box-post-job col-sm-6 col-lg-4 col-xl-4">
                                        <div class="box-icon shortlist">
                                            <img src="{{asset('public/img/chat.png')}}" alt="">
                                        </div>
                                        <div class="box-content shortlist">
                                            <h3 class="font-weight-bold">3</h3>
                                            <span>shortlist</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <h4> mes candidats </h4>

                         @foreach ($job_offers as $job_offer)
                        <div class="row applicants">
                            <div class=" col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2 entreprise-logo">

                                <div class="applicant-icon">
                                <img width="150px" height="100px" src="{{asset('img/'.$job_offer->offer_image)}}" alt="">

                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-md-8 col-lg-10 col-xl-10">
                                <div class="applicant-content">
                                    <div class="applicant-categorie mb-2">
                                        <span class="text-danger"></span>
                                        <span class="font-weight-bold"></span>
                                    </div>
                                    <div class="applicant-name mb-2">
                                        <a href="http://">
                                            @foreach ($job_offer->employer()->get() as $employer)
                                               {{$employer->entreprise_name}}
                                           @endforeach
                                         </a> -
                                        <span class="apply-date">
                                            {{$date1->locale($boringLanguage)->diffForHumans($job_offer->created_at)}}
                                                                            </div>
                                    <div class="applicant">
                                        <div class="applicant-info">
                                            <span class="applicant-location"> Location:</span><span>
                                                 @foreach ($job_offer->location()->get() as $location)
                                               {{$location->Name}}
                                                 @endforeach
                                            </span>
                                            <span class="applicant-salary"> Salary:</span><span>
                                                 @foreach ($job_offer->salary()->get() as $salary)
                                               {{$salary->Name}} DH/mois
                                                @endforeach

                                            </span>
                                        </div>
                                        <div class="view-applicant">
                                            <span> <a href="" class="href"><img
                                                        src="{{asset('public/img/download.png')}}" alt=""></a> </span>
                                            <span><a href="" class="href"><img src="{{asset('/img/eye.png')}}"
                                                        alt=""></a></span>
                                            <span><a href="" class="href"><img src="{{asset('/img/refresh.png')}}"
                                                        alt=""></a></span>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         @endforeach
                         <div class="d-flex justify-content-center mt-3">{!!$job_offers->links()!!}</div>
                    </div>
                </div>
    </div>
    @component('layouts.components.footer')

@endcomponent
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
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
