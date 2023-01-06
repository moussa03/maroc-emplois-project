
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
            <li class="p-3 {{ Request::segment(2) === 'applied_jobs'? 'active' : null }}">
            <span><i class="far fa-clone"></i>
            </span> Mes candidatures</li>
        </a>
        @endslot
        @slot('single_page')
        <a class="dropdown-item p-0" href="{{route('job_seeker/show_resumé',['username' => $username, 'id' => $job_seeker_id])}}">
            <li class="p-3">
                <span><i class="fas fa-receipt"></i>
                </span> mon résumé </li>
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
                <a class="dropdown-item p-0" href="{{route('job_seeker/change_password',$job_seeker_id)}}">
                    <li class="p-3">
                        <span><i class="fas fa-unlock-alt"></i>
                        </span> changer mot de passe </li>
                </a>
                @endslot
                @slot('log_out')

                <a   class="dropdown-item p-0" href="{{ route('logout') }}"
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
                <li class="p-3 text-danger" id="myBtn">
                 <span><i class="fas fa-trash"></i>
                 </span> supprimer mon compte </li>
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
                <div class="col-lg-9 col-xl-9 profile-content">
                    <div>
                        <span class="page-title font">
                            <h2 class="font-weight-bold"> Mes candidatures</h2>
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

                       </div>
                    <div class="container">
                         <div class="search_applied_jobs d-flex ">
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                  <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <form class="form-inline my-2 my-lg-0">
                                        <input class="form-control mr-sm-2" data-search type="search" placeholder="trouver" aria-label="Search">
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Trouver</button>
                                    </form>
                                  {{-- <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        order by
                                      </a>
                                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Newest</a>
                                        <a class="dropdown-item" href="#">oldest</a>

                                      </div>
                                    </li>

                                  </ul> --}}

                                </div>
                              </nav>

                         </div>
                        @foreach ($related_job_offers as $related_job_offer)
                        <div class="row applicants " data-filter-item data-filter-name="{{$related_job_offer->offer_title}}">

                            <div class=" col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2 entreprise-logo">

                                <div class="applicant-icon">
                                    <img width="150px" height="100px" src="{{asset('/img/'.$related_job_offer->offer_image)}}" alt="">

                                </div>
                            </div>
                            <div class="col-8 col-sm-8 col-md-8 col-lg-10 col-xl-10">
                                <div class="applicant-content" >
                                    <div class="applicant-categorie mb-2">
                                        <span class="text-danger">{{$related_job_offer->type_emploi}}</span>
                                        <span class="font-weight-bold" >{{$related_job_offer->offer_title}}</span>
                                    </div>
                                    <div class="applicant-name mb-2">
                                        <a href="http://">
                                           @foreach ($related_job_offer->employer()->get() as $employer)
                                               {{$employer->entreprise_name}}
                                           @endforeach
                                         </a> -
                                        <span class="apply-date">
                                            {{$date1->locale($boringLanguage)->diffForHumans($related_job_offer->created_at)}}

                                        </span>
                                    </div>
                                    <div class="applicant">
                                        <div class="applicant-info">
                                            <span class="applicant-location"> Location:</span><span>
                                                @foreach ($related_job_offer->location()->get() as $location)
                                               {{$location->Name}}
                                           @endforeach
                                            </span>
                                            <span class="applicant-salary"> Salary:</span><span>
                                                @foreach ($related_job_offer->salary()->get() as $salary)
                                               {{$salary->Name}} DH/mois
                                           @endforeach

                                            </span>
                                        </div>
                                        <div class="view-applicant">
                                            {{-- <span> <a href="" class="href"><img
                                                        src="{{asset('public/img/download.png')}}" alt=""></a> </span>
                                            <span><a href="" class="href"><img src="{{asset('public/img/eye.png')}}"
                                                        alt=""></a></span>
                                            <span><a href="" class="href"><img src="{{asset('public/img/refresh.png')}}"
                                                        alt=""></a></span>
                                            <span><a href="" class="href"><img src="{{asset('public/img/garbage.png')}}"
                                                        alt=""></a></span> --}}
                                                        <form method="POST" action="{{route('delete/applied_jobs',['job_seeker_id'=>$job_seeker_id,'job_offer_id'=>$related_job_offer->id])}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-default delete_applied_offer">
                                                                <span><i class="fa fa-trash"></i></span>
                                                            </button>
                                                         </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                        <div class="d-flex justify-content-center mt-3">{!!$related_job_offers->links()!!}</div>
                    </div>
                </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js"
integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
crossorigin="anonymous">

</script>
    <script>

        $(document).ready(function() {

               $('[data-search]').on('keyup', function () {
                   var searchVal = $(this).val();
                   var filterItems = $('[data-filter-item]');

                   if (searchVal != '') {
                       filterItems.addClass('hidden');
                       $('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');
                   } else {
                       filterItems.removeClass('hidden');
                   }
               });

               $('.login-back').click(function () {
                   $('.login-form').fadeToggle(1000);
                   $('.forgot-password').hide();
               });

               $('.forgot-Password').click(function () {
                   $('.forgot-password').fadeToggle(1000);
                   $('.login-form').hide();

               });

               });
           </script>
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
    @component('layouts.components.footer')

    @endcomponent
    @endsection
