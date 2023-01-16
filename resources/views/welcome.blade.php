@extends('job_board_layout.app')
<?php
use App\Job_offer;
// $latest_job_offer['created_at']->locale('fr');
Carbon\Carbon::setLocale('fr');

$boringLanguage = 'fr';
$translator = \Carbon\Translator::get($boringLanguage);
$date1 = Carbon\Carbon::now();
$translator->setTranslations([
    'after' => function ($time) {
        return 'publié'.' '.''.$time.' avant';
    },
]);
?>
@section('content')

<div class="container-fluid front-page p-0">
          <video autoplay muted  id="myVideo" loop>
            <source src="{{ asset('video/Office-Day.mp4') }}" type="video/mp4" controls poster="{{asset('img/home-background.png')}}">
        </video>
        <div class="header-overlay">
          </div>

<div> <h1 class="first-heading text-center">  Recherche d’emploi

</h1></div>
<section class="search-form">
<form action="{{route('job_seeker/login')}}" method="GET" name="search" role="search" class="form-search">
      <p class="inp-wrap search-wrap col-6 col-sm-12 col-md-12 col-lg-4 p-0">
        <input type="search" name="search-term" id="search-field" class="grid" placeholder="Recherche mots clés:" />
      </p>
      <p class="inp-wrap cat-wrap col-12 col-sm-12 col-md-12 col-lg-4 p-0">
      <select name="search categories" id="categories" class="grid">
          <option value="" disabled selected> fonction</option>
          @foreach ($all_categories as $categoy)
      <option value="{{$categoy->id}}">{{$categoy->Name}}</option>
          @endforeach
        </select>
        <span class="sec2 d-none d-lg-block"></span>
        <span class="arow"><i class="fa fa-angle-down"></i></span>
      </p>
      <p class="inp-wrap cat-wrap col-12 col-sm-12 col-md-12 col-lg-4 p-0">
        <select name="search categories" tabindex="-1" id="categories" class="grid">
            <option value="0" selected disabled>ville</option>
            @foreach ($all_locations as $location)
            <option value="{{$location->id}}">{{$location->Name}}</option>
                @endforeach
        </select>
        <span class="sec1 d-none d-lg-block"></span>
        <span class="arow"><i class="fa fa-angle-down"></i></span>
      </p>

      <p class="inp-wrap submit-wrap grid col-12 col-sm-12 col-md-12 col-lg-4 p-0">
        <button class="search-button btn" href="#ex1" >
          <!-- Generated by IcoMoon.io -->
          {{-- <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> --}}
         <span>rechercher</span>
         <span><i class="fa fa-search"></i></span>
        </button>

      </p>
    </form>
  </section>
  <div>
    <span class="caption">
        Trouvez l'emploi que vous méritez
    </span>
  </div>

</div>
<div class="counting d-flex flex-wrap justify-content-around container align-items-center">
 <div class="all-jobs p-4 d-flex align-items-center col-6 col-sm-6 col-md-3 col-lg-3">
     <div class="mr-2"><img src="{{asset('img/work.png')}}" alt=""></div>
     <div class="count-jobs">
         <span class="font-weight-bold">{{$all_jobs->count()}}</span>
         <span>Offres en ligne </span>
     </div>
 </div>
 <div class="all-jobs p-4 d-flex align-items-center col-6 col-sm-6 col-md-3 col-lg-3">
    <div class="mr-2"><img src="{{asset('img/user-profiles.png')}}" alt=""></div>
    <div class="count-jobs">
        <span class="font-weight-bold">{{$all_jobs_seeker->count()}}</span>
        <span>CVs ouverts</span>
    </div>
</div>
<div class="all-jobs p-4 d-flex align-items-center col-6 col-sm-6 col-md-3 col-lg-3">
    <div class="mr-2"><img src="{{asset('img/flag.png')}}" alt=""></div>
    <div class="count-jobs">
        <span class="font-weight-bold">{{$all_employers->count()}}</span>
        <span>Recruteurs actifs   </span>
    </div>
</div>
<div class="all-jobs p-4 d-flex align-items-center col-6 col-sm-6 col-md-3 col-lg-3">
    <div class="mr-2"><img src="{{asset('img/right.png')}}" alt=""></div>
    <div class="count-jobs">
        <span class="font-weight-bold">{{$all_application->count()}}</span>
        <span>applicants</span>
    </div>
</div>

</div>
<div class="featured-jobs">
    <p class="text-center"> DERNIERS OFFRES </p>
    <span class="text-center d-block lead">Des centaines d'offres d'emploi au maroc</span>
</div>
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div id="news-slider" class="owl-carousel">

                @foreach ($latest_job_offers  as $latest_job_offer)

                <div class="post-slide">

                    <div class="post-img">
                    <a href="{{route('submit/single_offer',$latest_job_offer->id)}}">
                                <img style="" src="{{asset('img/'.$latest_job_offer->offer_image)}}" alt="">
                                    <div class="post-date">
                                        {{-- @php $date = Carbon\Carbon::parse($latest_job_offer['created_at'])->locale('fr_FR'); @endphp --}}
                                        @php $date= Carbon\Carbon::translateTimeString(Carbon\Carbon::parse($latest_job_offer['created_at'])->format('F'), 'en', 'fr')  @endphp
                                        <span class="date">{{Carbon\Carbon::parse($latest_job_offer['created_at'])->format('d') }}</span>
                                        {{-- <span class="month">{{Carbon\Carbon::parse($latest_job_offer['created_at'])->format('F')}}</span> --}}
                                    <span class="month">{{$date}}</span>
                                    </div>
                      </a>


                    </div>
                    <div class="post-review">
                    <h3 class="post-title"><a href="{{route('submit/single_offer',$latest_job_offer->id)}}">{{$latest_job_offer->offer_title}}</a></h3>
                        <ul class="post-bar">
                            <li><i class="far fa-check-square"></i><a href="{{route('submit/single_offer',$latest_job_offer->id)}}">{{$latest_job_offer->category->Name}}</a></li>
                            <li><i class="fas fa-map-marker-alt"></i><a href="{{route('submit/single_offer',$latest_job_offer->id)}}">{{$latest_job_offer->location->Name}}</a></li>
                        </ul>
                    <p class="post-description">

                        {!! \Illuminate\Support\Str::words($latest_job_offer->description, 9,'....')  !!}

                    </p>

                    </div>
                    <form method="GET" action="{{route('submit/single_offer',$latest_job_offer->id)}}">
                        <button class="btn btn-outline-primary" >postuler a cette offre</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class=" d-block d-md-none ">
        <div class="container bg-mobile ">
        <p class="font-weight-bold">Meteojob, premier site de matching.</p>
        <p>dans l'emploi au maroc, propose chaque jour des offres d'emploi qui correspondent à votre profil.</p>
    </div>
</div>

<div class="popular_catergorie">
   <div class="top-category-title">
    <p class="display-4 text-center">OFFRES PAR CATÉGORIE</p>
    <span class="text-center d-block lead">A better career is out there. We'll help you find it. We're your first step to becoming everything you want to be.</span>
  </div>
</div>
<div class="container text-center categorie-icons">
    <div class="row">
      <div class="col-12 col-sm-4 col-lg-3">
        
          <div class="categorie-icon">
            <a>  
              <img src="{{asset('home-icons/megaphone.svg')}}" id="img-icon"/>
              <span>vente et commercial </span>
              <span> <?php $projects = Job_offer::where('category_id',29)->count(); ?>
                ({{$projects}} emplois)
              </span>
            </a>
          </div>
        
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/construction.svg')}}" id="img-icon"/>
            <span>travaux et chantiers</span>
            <span> <?php $projects = Job_offer::where('category_id',47)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/education.svg')}}" id="img-icon"/>
            <span> enseignement  </span>
            <span> <?php $projects = Job_offer::where('category_id',33)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/accounting.svg')}}" id="img-icon"/>
            <span>banque et finance</span>
            <span> <?php $projects = Job_offer::where('category_id',34)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/automation.svg')}}" id="img-icon"/>
            <span> transport et distribution</span>
            <span> <?php $projects = Job_offer::where('category_id',48)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4  col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/headphones.svg')}}" id="img-icon"/>
            <span> centre d'appels  </span>
            <span> <?php $projects = Job_offer::where('category_id',42)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/hospitalisation.svg')}}" id="img-icon"/>
            <span>santé et hospitalisation</span>
            <span> <?php $projects = Job_offer::where('category_id',45)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
      <div class="col-12 col-sm-4 col-lg-3">
        <div class="categorie-icon">
          <a>  
            <img src="{{asset('home-icons/restaurant.svg')}}" id="img-icon"/>
            <span>réstauration</span>
            <span> <?php $projects = Job_offer::where('category_id',42)->count(); ?>
              ({{$projects}} emplois)
            </span>
          </a>
        </div>
      </div>
    </div>
</div>
   <div class="container">
    <div class="popular_catergorie">
      <div class="top-category-title">
       <p class="display-4 text-center">OFFRES EN LIGNE</p>
       <span class="text-center d-block lead">A better career is out there. We'll help you find it. We're your first step to becoming everything you want to be.</span>
     </div>
   </div>
   <div class="row">
   @foreach ($latest_job_offers as $job)
   
    <div class="col-lg-6">
      <div class="last-jobs">
        <div class="job-thumbnail">
          
           <a href="{{route('submit/single_offer',$job->id)}}"><img src="{{asset('img/'.$job->offer_image)}}" width="100px" alt=""> </a> 
          
        </div>
        <div class="featured-job-description">
          <div class="featured-job-detail ">
            <a href="{{route('submit/single_offer',$job->id)}}"><span> {{$job->offer_title}}</span></a>
            @php $date= Carbon\Carbon::translateTimeString(Carbon\Carbon::parse($job['created_at'])->format('F'), 'en', 'fr')  @endphp
            <span> {{$date1->locale($boringLanguage)->diffForHumans($job->created_at)}}</span>
          </div>
          {{-- <hr> --}}
          <div class="featured-job-extra-details">
            <div class="job-extra-details">
              <ul class="post-bar">
                <li><i class="far fa-check-square"></i><a href="{{route('submit/single_offer',$job->id)}}">{{$job->category->Name}}</a></li>
                <li><i class="fas fa-map-marker-alt"></i><a href="{{route('submit/single_offer',$job->id)}}">{{$job->location->Name}}</a></li>
            </ul>
            </div>
            <div class="d-none d-sm-block">
              <div class="featured-job-type">
                <span class="badge text-bg-primary">{{$job->type_emploi}}</span>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
   
   @endforeach
  </div>
   </div>
  <div class="container-fluid hero-banner">
    <div class="container hero-banner-content">
      <div class="row">
        
        <div class="col-sm-6 col-lg-8">
          <div class="hero-top-text mb-2">
            <p>MILLIONS OF JOBS.
            </p>
            <p>FIND THE ONE THAT’S RIGHT FOR YOU.
            </p>
          </div>
          <div class="hero-content mb-2">
            <p>Search all the open positions on the web. Get your own personalized salary estimate. Read reviews on over 600,000 companies worldwide. The right job is out there</p>
          </div>
          <div class="hero-button">
            <button type="button" class="btn btn-outline-primary mt-2 mb-2">Trouver un emploi</button>

          </div>
        
         
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="hero-image">
            <img src="{{asset('img/hero-image.jpg')}}" class="w-100 mb-2" alt="">
          </div>
        </div>
    </div>
    </div>
     
  </div>

  <div class="container">
    <section id="testim" class="testim">
      <div class="testim-cover">
         <div class="wrap">

             <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
             <span id="left-arrow" class="arrow left fa fa-chevron-left "></span>
             <ul id="testim-dots" class="dots">
                 <li class="dot active"></li><!--
                 --><li class="dot"></li><!--
                 --><li class="dot"></li><!--
                 --><li class="dot"></li><!--
                 --><li class="dot"></li>
             </ul>
             <div id="testim-content" class="cont">
                 
                 <div class="active">
                     <div class="img"><img src="{{asset('img/testimonial.png')}}" alt=""></div>
                     <h2>Anass.S</h2>
                     <p> Le support candidat fonctionne à merveille. J’ai tout de suite eu une personne pour m’écouter, me conseiller, et régler mon problème pour que je puisse à nouveau postuler. Je tiens à remercier toute l´équipe pour sa réactivité et son professionnalisme. Vous êtes les meilleurs dans le domaine de recrutement !.</p>                    
                 </div>

                 <div>
                     <div class="img"><img src="{{asset('img/testimonial.png')}}" alt=""></div>
                     <h2>Amin.M</h2>
                     <p> Pendant ma recherche d’emploi, me confronter aux sites de recrutement a été une expérience très lourde. Des sites qui ne donnent de l’importance qu’aux profils basiques et aux recrutements de masse sans aucune exigence de qualification. Une collègue m’a conseillé votre site, leader en recrutement digital qui est sollicité par les plus grandes entreprises.
                      Je tiens à témoigner de la qualité du contenu de votre site, de vos précieux </p>                    
                 </div>

                 <div>
                     <div class="img"><img src="{{asset('img/testimonial.png')}}" alt=""></div>
                     <h2>Hicham.k</h2>
                     <p> J'aime vraiment Maroc-emploi, j'ai postulé plusieurs fois via ce site et je le fais encore aujourd’hui. J'ai en effet été contacté plusieurs fois par les entreprises pour des opportunités d'emploi qui correspondent à mon profil.</p>                    
                 </div>

                 <div>
                     <div class="img"><img src="{{asset('img/testimonial.png')}}" alt=""></div>
                     <h2>Rachida.M</h2>
                     <p> J'ai réussi à décrocher plusieurs entretiens avec les meilleures entreprises du marché grâce à ReKrute, et je suis actuellement embauchée par une grande entreprise de renommée nationale et internationale.
                      Merci beaucoup l'équipe Maroc-emplois!.</p>                    
                 </div>

                 <div>
                     <div class="img"><img src="{{asset('img/testimonial.png')}}" alt=""></div>
                     <h2>Salma.E</h2>
                     <p> J'aime vraiment ReKrute, j'ai postulé plusieurs fois via ce site et je le fais encore aujourd’hui. J'ai en effet été contacté plusieurs fois par les entreprises pour des opportunités d'emploi qui correspondent à mon profil.</p>                    
                 </div>

             </div>

         </div>
      </div>
 </section>
  </div>
  <script src="{{asset('js/testimonial.js')}}"></script>
  @component('layouts.components.footer')
  @endcomponent

@endsection

