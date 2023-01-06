
@extends('job_board_layout.app')
@section('content')
<div class="container dashboard-header mt-5">
 <div class="top-resume d-flex justify-content-between align-items-center">
   <div class="info-job_seeker  flex-wrap d-flex justify-content-between align-items-center">
   <div class="p-2 pic-resume"> <img  style="width:90px;height:90px" src="{{asset('img/'.$job_seeker->profile_picture)}}" alt=""></div>
     <div class="p-2">
         <div class=" "><h3 class="font-weight-bold">{{$job_seeker->username}}</h3></div>
         <div class=" d-flex align-items-center justify-content-start">
             <div class="resume-poste">
                 <span><img src="{{asset('img/check-square.png')}}" alt=""></span>
                 <span>
                     @foreach ($job_seeker_cat_names as $name)
                        {{$name->Name}}
                    @endforeach
                </span>
            </div>
            <div class="resume-map"> <span><img src="{{asset('img/maps-and-flags.png')}}" alt=""></span>
             <span>
                @foreach ($job_seeker_loc_names as $name)
                {{$name->Name}}
                @endforeach
            </span>
        </div>
        <div>
            <span><img src="{{asset('img/download.png')}}" alt=""></span>
            </button>

            <button type="button" class="btn btn-success download-fiche"><a method="get" href="{{route('download/cv',['id'=>$job_seeker->id,'username'=>$job_seeker->username])}}"  class="active">télécharger cv</a></button>

         </div>
        </div>
     </div>
   </div>

 </div>
</div>
<div class="container d-flex justify-content-between   dashboard-header mt-0">
  <div class=" d-flex justify-content-between align-items-center">
       <span class=" mr-3 font-weight-bold">compétences: </span>
       <div class="resume-tags  flex-wrap">
           @foreach ($skills as $skill)
           <span>{{$skill->Name}}</span>
           @endforeach

        </div>
 </div>
  <div class="resume-social">
 <span>social:</span>
  <span><a href="http://"><img src="{{asset('img/facebook.png')}}" alt=""></a></span>
      <span><a href="http://"><img src="{{asset('img/twitter.png')}}" alt=""></a></span>
      <span><a href="http://"><img src="{{asset('img/linkedin.png')}}" alt=""></a></span>
      <span><a href="http://"><img src="{{asset('img/google-plus.png')}}" alt=""></a></span>

  </div>

</div>
<div class="container dashboard-header mt-0">
<hr>
</div>

<div class="container dashboard-header mt-0">
   <div class="row">
       <div class="col-xl-6">
            <div class="resume-about-title ">
                    <span><img src="{{asset('img/left-align.png')}}" alt=""></span>
                    <span class="ml-2">à propos</span>
            </div>
            <div class="ml-4">
                    <p class="about-content">
                        {!!$job_seeker->description!!}
                    </p>
             </div>
             <div class="resume-about-title ">
                    <span><img src="{{asset('img/students-cap.png')}}" alt=""></span>

                    <span class=" font-weight-bold ml-2">education </span>

            </div>
            <div class="ml-4">
                    <div class="resume-education">
                            <div class="education-title d-flex  align-items-center">

                            </div>
                             @foreach ($educations as $education)
                             <div class="education-diploma">
                                    <ul class="education-diploma-title">

                                            <li class="diploma">
                                                 <li class="diploma-date">
                                                 <span class="cercle"></span> <span>{{$education->diplome_date}}</span>
                                                 </li>
                                                <span class="title font-weight-bold">{{$education->diplome_name}}</span>- <span>{{$education->school_name}}</span>
                                                 <p class="ml-3">{{$education->description}}</p>
                                            </li>

                                    </ul>
                             </div>
                             @endforeach
                    </div>
             </div>
             <div class="resume-about-title ">
                    <span><img src="{{asset('img/suitcase.png')}}" alt=""></span>

                    <span class="font-weight-bold ml-2"> experiences</span>

            </div>
            <div class="ml-4">
                    <div class="resume-education">
                            <div class="education-title d-flex  align-items-center">

                            </div>
                            @foreach ($experiences as $experience)
                            <div class="education-diploma">
                                    <ul class="education-diploma-title">

                                            <li class="diploma">
                                                 <li class="diploma-date">
                                                 <span class="cercle"></span> <span> de {{$experience->start_date}} A {{$experience->end_date}}</span>- <span class=" font-weight-bold">{{$experience->entreprise_name}}</span>
                                                 </li>
                                                 <span class="title font-weight-bold">{{$experience->poste_name}}</span>
                                                 <p class="ml-3">{{$experience->description}}.</p>
                                            </li>

                                    </ul>

                                 </div>
                            @endforeach
                    </div>
             </div>

             <div class="resume-about-title ">
                    <span><img src="{{asset('img/skills.png')}}" alt=""></span>

                    <span class="font-weight-bold ml-2"> compétences</span>

            </div>
            <div class="ml-4">
                    <div class="resume-education">
                            <div class="education-title d-flex  align-items-center">

                            </div>
                            <div class="wrapper m-0">
                                    <div class="container">
                                        @foreach ($skills as $skill)
                                        <div class="skillbar" data-percent="{{$skill->performance}}">
                                                <span class="skillbar-title" >{{$skill->Name}}</span>
                                                <p class="skillbar-bar"></p>
                                                <span class="skill-bar-percent"></span>
                                              </div>
                                        @endforeach


                                  </div>
                            </div>
                    </div>
             </div>
       </div>
       <div class="col-xl-2">

       </div>
       <div class="col-xl-4 resume-side-bar">
            <div class="sidebar-content">
                <h5 class="mb-3">information</h5>
                <hr class="border">

                <ul class="list-resume-info">
                    <li> <span> email:</span> <span class="resume-info-title">
                            {{$job_seeker->email}}
                        </span></li>
                    <li> <span> categorie:</span> <span class="resume-info-title">
                            @foreach ($job_seeker_cat_names as $name)
                            {{$name->Name}}
                            @endforeach
                        </span></li>
                    <li> <span> ville:</span> <span class="resume-info-title">
                            @foreach ($job_seeker_loc_names as $name)
                            {{$name->Name}}
                            @endforeach</span>
                    </li>
                    <li> <span> sexe:</span> <span class="resume-info-title"> {{$job_seeker->gender}}</span></li>
                    <li> <span> num de tél:</span> <span class="resume-info-title">{{$job_seeker->phone}}</span></li>

                    <li> <span> age:</span> <span class="resume-info-title"> {{$job_seeker->age}}</span></li>

                </ul>
                </ul>

            </div>


        </div>
      </div>
   </div>
</div>

{{-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

<script src="{{ asset('js/skill_bar.js') }}" defer></script>
@component('layouts.components.footer')

@endcomponent

@endsection
