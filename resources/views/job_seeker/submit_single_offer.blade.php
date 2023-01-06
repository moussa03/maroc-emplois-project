
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
<div class="container dashboard-header mt-5">
    @if ($updated = Session::get('succes'))
<div class="alert alert-success alert-block mb-0 text-center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $updated }}</strong>
</div>
@endif
 <div class="top-resume d-flex justify-content-between align-items-center">
   <div class="info-job_seeker d-flex justify-content-between align-items-center">
   <div class="p-2 pic-resume"> <img  style="width:90px;height:90px" src="{{asset('img/'.$job_offer->offer_image)}}" alt=""></div>
     <div class="p-2">
     <div class=" "><h3 class="font-weight-bold">{{$job_offer->offer_title}}</h3></div>
         <div class=" d-flex justify-content-start">
             <div class="resume-poste">
                 <span><img src="{{asset('img/check-square.png')}}" alt=""></span>
                 <span>
                    {{$job_offer->employer->entreprise_name}}

                </span>
            </div>
            <div class="resume-map"> <span><img src="{{asset('img/maps-and-flags.png')}}" alt=""></span>
             <span>
                {{$job_offer->location->Name}}
            </span>
        </div>

        </div>
     </div>
   </div>
   <div>
       <span><img src="{{asset('img/download.png')}}" alt=""></span>
       </button>
       {{-- <a  method="get" href="{{route('download/fiche',['id'=>$employer->id,'username'=>$employer->username])}}"  class="active">download</a> --}}

    </div>
 </div>
</div>
<div class="container d-flex justify-content-between   dashboard-header mt-0">

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
    <form  method="POST" action="{{route('send/random_offer',['id'=>$job_offer->employer->id,'job_offer_id'=>$job_offer->id])}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-detail fade" id="modalRegisterForm{{$job_offer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">                    <div class="modal-dialog" role="document">
       <div class="modal-content-detail">
         <div class="modal-header text-center">
           <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body mx-3">
           <div class="md-form mb-5">
             <i class="fas fa-user prefix grey-text"></i>
             <input type="text" id="orangeForm-name" class="form-control validate">
             <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
           </div>
           <div class="md-form mb-5">
             <i class="fas fa-envelope prefix grey-text"></i>
             <input type="email" id="orangeForm-email" class="form-control validate" name="email">
             <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
           </div>

           <div class="md-form mb-4">
             <i class="fas fa-lock prefix grey-text"></i>
             <input type="file" id="orangeForm-pass"  name="file">
             <label data-error="wrong" data-success="right" for="orangeForm-pass">cv</label>
           </div>
           <div class="md-form mb-4">
             <i class="fas fa-lock prefix grey-text"></i>
             <input type="submit" id="orangeForm-pass" class="form-control validate" value="submit">
             <label data-error="wrong" data-success="right" for="orangeForm-pass"></label>
           </div>
         </div>
       </div>
     </div>
   </div>
 </form>
       <div class="col-xl-6">
            <div class="resume-about-title ">
                    <span><img src="{{asset('img/left-align.png')}}" alt=""></span>
                    <span class="ml-2">about</span>
            </div>
            <div class="ml-4">
                    <p class="about-content">
                         {!!$job_offer->description!!}
                    </p>
             </div>

            {{-- <div class="ml-4">
                <span><img src="{{asset('img/success.png')}}" alt=""></span>
                <span class=" font-weight-bold">open job</span>


             </div> --}}
               {{-- @foreach ($job_offers as $job_offer) --}}
               <hr class="mt-5">
             <div class="open-job d-flex justify-content-between align-items-center ml-4 mt-3">

                 <div class="job-detail">
                    <div>
                    <span class=" font-weight-bold">{{$job_offer->offer_title}}</span>
                   </div>
                    <div class="job-detail-item mt-3">
                        <span>
                        <img src="{{asset('img/maps-and-flags.png')}}" alt="">
                        {{$job_offer->location->Name}}
                        </span>
                        <span>
                            <img src="{{asset('img/time.png')}}" alt="">
                         {{$job_offer->type_emploi}}
                        </span>
                        <span>
                            {{-- {{$job_offer->id}} --}}
                        </span>
                   </div>
                </div>
                <div class="apply-job">
                {{-- <form  method="POST" action="{{route('send/offer',['id'=>$job_seeker->id,'employer_id'=>$job_offer->employer->id,'offer_id'=>$job_offer->id])}}"> --}}
                    {{-- @csrf --}}
                    <button class="apply" data-toggle="modal" data-target="#modalRegisterForm{{$job_offer->id}}">
                        apply
                    </button>

                {{-- </form> --}}


                     <span class="mt-2"> {{$date1->locale($boringLanguage)->diffForHumans($job_offer->created_at)}}</span>

                </div>


             </div>
              {{-- @endforeach --}}



       </div>
       <div class="col-xl-2">

       </div>
       <div class="col-xl-4 resume-side-bar">
            <div class="sidebar-content">
                <h5 class="mb-3">information</h5>
                <hr class="border">

                <ul class="list-resume-info">
                    <li> <span> published on:</span> <span class="resume-info-title">{{ Carbon\Carbon::parse($job_offer->created_at)->format('Y-m-d') }}

                    </span></li>
                    <li> <span> entreprise name:</span> <span class="resume-info-title">{{$job_offer->employer->entreprise_name}} </span></li>
                    <li> <span> email:</span> <span class="resume-info-title">
                            {{$job_offer->employer->email}}
                        </span></li>
                    <li> <span> category:</span> <span class="resume-info-title">
                            {{$job_offer->category->Name}}
                        </span></li>
                    <li> <span> location:</span> <span class="resume-info-title">
                            {{$job_offer->location->Name}}
                        </span>
                    </li>
                <li> <span> phone:</span> <span class="resume-info-title">{{$job_offer->employer->phone}}</span></li>
                <li> <span> team_mebers:</span> <span class="resume-info-title">{{$job_offer->employer->team_members}}</span></li>
                <li> <span> experience:</span> <span class="resume-info-title">{{$job_offer->experience->Name}}</span></li>
                 <li> <span> salary:</span> <span class="resume-info-title">  {{$job_offer->salary->Name}}</span></li>
                 <li> <span> emploi staus:</span> <span class="resume-info-title">{{$job_offer->type_emploi}}</span></li>

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

@endsection
