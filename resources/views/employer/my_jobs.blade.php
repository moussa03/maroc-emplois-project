
@extends('job_board_layout.app')
@section('content')
@if ($updated = Session::get('deleted'))
<div class="alert alert-success alert-block mb-0 text-center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $updated }}</strong>
</div>
@endif
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
            <li class="p-3"><span><i class="fa fa-th-large"></i></span> tableau de bord</li>

        @endslot
        @slot('profile')
        <a class="dropdown-item p-0" href="{{route('employer/profile',$employer_id)}}">
            <li class="p-3">
                <span><i class="fa fa-user"></i>
                </span>  profile </li>
        </a>
        @endslot
        @slot('pup_anonnce')
                <a class="dropdown-item p-0" href="{{route('register/job_offer',$employer)}}">
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
                <a href="{{route('employer/details',$employer_id)}}">
                    <li class="p-3"> <span><i class="fas fa-receipt"></i>
                    </span>  détails</li>
                 </a>
                @endslot
        @slot('username')
        {{$employer->username}}
        @endslot
        @slot('poste')
        {{$employer->poste}}
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

                <form id="logout-form" action="{{ route('employer/logout') }}" method="POST" style="display: none;">
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

        <div class="col-lg-9 col-xl-9 dashboard-content">
            <div>
                <span class="page-title font ">
                    <h2 class="font-weight-bold mb-5"> dashboard</h2>
                     {{-- <div class="d-lg-none d-xl-none">
                            @component('layouts.components.navbar_small_device')

                            @endcomponent
                     </div> --}}
                </span>
                <div class="main mb-4">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="main mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="trouver offer">
                                <div class="input-group-append">
                                  <button class="btn btn-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="jobs_filter">
                                  <span> sort by :</span>
                                  <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Newest
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="#">default</a>
                                          <a class="dropdown-item" href="#">newest</a>
                                          <a class="dropdown-item" href="#">older</a>

                                        </div>
                                      </div>
                             </div>
                        </div>
                      </nav>
                </div>
            </div>
            <div class="container">

                <div class="row applicants">

                    <div class="col-lg-12 col-xl-12">
                    @foreach ($job_offers as $job_offer)
                      <div class="job-applicant-content">
                      <div class="my-jobs-content">
                       <div class="applicant-categorie mb-2">
                       <span class="text-danger">{{$job_offer->type_emploi}}</span>
                       </div>
                       <div class="applicant-name mb-2  ">
                        <a href="" class="my-jobs-title">{{$job_offer->offer_title}}</a>
                        <div class="mt-3">
                        <span>applicant(s) </span>
                        <span class="rounded-job-number">
                        <form  method="GET" action="{{route('show/applicant',['id'=>$job_offer->employer->id,'offer_id'=>$job_offer->id])}}">
                         <button type="submit" class="btn-count">
                            {{$job_offer->job_seeker_count}}
                         </button>
                         </form>
                        </span>
                        </div>

                       </div>
                       <div class="applicant ">
                         <div class="applicant-info">
                             <span class="applicant-location"> </span><span>{{$date1->locale($boringLanguage)->diffForHumans($job_offer->created_at)}}</span>
                             {{-- <span class="applicant-salary"> expired:</span><span>{{$job_offer->created_at}}</span> --}}
                        </div>

                       </div>
                    </div>
                       <div class="job-view-applicant">
                       <form method="GET" action="{{route('show/offer',['id'=>$job_offer->employer->id,'offer_id'=>$job_offer->id])}}">
                        @csrf
                            <button type="submit" class="btn btn-default employer-jobs">
                                <span class="edit-job"><i class="far fa-edit"></i> </span>
                            </button>
                        </form>
                    <form method="POST" action="{{route('delete/job',['id'=>$job_offer->employer->id,'offer_id'=>$job_offer->id])}}">
                        @csrf
                            <button type="submit" class="btn btn-default employer-jobs">
                                <span class="remove-job"> <i class="far fa-trash-alt"></i> </span>
                            </button>
                    </form>
                       </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="d-flex justify-content-center mt-3">{!!$job_offers->links()!!}</div>
                    </div>

                </div>


            </div>

        </div>


    </div>

</div>
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
