<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>maroc-emplois - @yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/style_skill_bar.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <link rel="stylesheet" href="{{asset('css/style_menu.css')}}">
   <link rel="stylesheet" href="{{asset('css/testimonial.css')}}">
    {{-- <link href="{{ asset('css/style_single_page.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>

</head>
<body>
    <div id="app">
        <div class="container-fluid pl-0 pr-0">
            <nav class="navbar navbar-expand-lg navbar-mainbg">
                <a class="navbar-brand navbar-logo" href="{{url('job_seeker/index')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <div class="hori-selector"><div class="left"></div><div class="right"></div></div>

                         @if((auth()->guard('job_seeker')->check()))
                            <li class="nav-item {{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                                <a class="nav-link" href="{{ url('job_seeker/dashboard',Auth::guard('job_seeker')->user()->id)}}"><i class="fas fa-tachometer-alt"></i>tableau de bord</a>
                           </li>

                           @else
                            <li class="nav-item {{ Request::segment(2) === 'dashboard' ? 'active' : null }}">
                                <a class="nav-link" href="{{ url('employer/dashboard',Auth::guard('employer')->user()->id)}}"><i class="fas fa-tachometer-alt"></i>tableau de bord</a>
                          @endif
                          @if((auth()->guard('job_seeker')->check()))
                          <li class="nav-item {{ Request::segment(3) === 'job_listings' ? 'active' : null }}">

                              <a class="nav-link" href="{{route('job_seeker/jobs',Auth::guard('job_seeker')->user()->id)}}"><i class="far fa-list-alt"></i>offres d'emploi</a>
                         </li>

                         {{-- @else
                          <li class="nav-item {{ Request::segment(2) === 'candidates' ? 'active' : null }}">
                              <a class="nav-link" href="{{route('show/candidates',Auth::guard('employer')->user()->id)}}"><i class="fas fa-tachometer-alt"></i>candidates</a> --}}
                        @endif

                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item {{ Request::segment(2) === 'my_profile' ? 'active' : null }} ">
                            <a href="{{route('job_seeker/profile',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="far fa-address-book"></i>profile</a>
                        </li>

                        @else
                        <li class="nav-item {{ Request::segment(2) === 'profile' ? 'active' : null }} ">
                            <a href="{{route('employer/profile',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="far fa-address-book"></i>profile</a>
                        </li>

                        @endif
                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item {{ Request::segment(2) === 'applied_jobs' ? 'active' : null }} ">
                            <a href="{{route('job_seeker/applied_jobs',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="far fa-clone"></i>Mes candidatures</a>
                        </li>
                        @else
                        <li class="nav-item {{ Request::segment(3) === 'my_jobs' ? 'active' : null }} ">
                            <a href="{{route('employer/my_jobs',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="far fa-clone"></i>mes offres</a>
                        </li>

                        @endif
                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item {{ Request::segment(2) === 'resume' ? 'active' : null }} ">
                            <a href="{{route('job_seeker/resume',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="far fa-calendar-alt"></i>publier mon resumé</a>
                        </li>
                        @else
                        <li class="nav-item {{ Request::segment(2) === 'register_job_offer' ? 'active' : null }} ">
                            <a href="{{route('register/job_offer',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="far fa-calendar-alt"></i>publier une  annonce</a>
                        </li>
                        @endif
                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item {{ Request::segment(4) === 'resumé' ? 'active' : null }}">

                            <a href="{{route('job_seeker/show_resumé',['id'=>Auth::guard('job_seeker')->user()->id,'username'=>Auth::guard('job_seeker')->user()->username])}}" class="nav-link"><i class="fas fa-receipt"></i>mon résumé</a>
                        </li>
                        @else
                         <li class="nav-item {{ Request::segment(4) === 'resumé' ? 'active' : null }}">

                            <a href="{{route('employer/details',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="fas fa-receipt"></i> détail</a>
                        </li>

                        @endif
                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item {{ Request::segment(2) === 'change_password' ? 'active' : null }}" >

                            <a href="{{route('job_seeker/change_password',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="fas fa-unlock-alt"></i>changer mot de passe</a>
                        </li>
                        @else
                        <li class="nav-item {{ Request::segment(2) === 'change_password' ? 'active' : null }}" >

                            <a href="{{route('employer/change_password',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="fas fa-unlock-alt"></i>changer mot de passe</a>
                        </li>

                        @endif
                        @if((auth()->guard('job_seeker')->check()))
                        <li class="nav-item drop-item">
                            {{-- <a href="{{route('job_seeker/logout',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="far fa-copy"></i>log out</a> --}}
                           <ul class="drop-menu">
                            <li class="nav-item item-show"><a href="{{route('job_seeker/change_password',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="fas fa-chevron-down"></i>{{Auth::guard('job_seeker')->user()->username}}</a></li>
                            <li class="nav-item item-hide d-none"><a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('job_seeker/logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form></li>
                           </ul>


                        </li>
                        @else
                        <li class="nav-item drop-item">
                            {{-- <a href="{{route('job_seeker/logout',Auth::guard('job_seeker')->user()->id)}}" class="nav-link"><i class="far fa-copy"></i>log out</a> --}}
                           <ul class="drop-menu">
                            <li class="nav-item item-show"><a href="{{route('employer/change_password',Auth::guard('employer')->user()->id)}}" class="nav-link"><i class="fas fa-chevron-down"></i>{{Auth::guard('employer')->user()->username}}</a></li>
                            <li class="nav-item item-hide d-none"><a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>

                             <form id="logout-form" action="{{ route('employer/logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form></li>
                           </ul>

                        </li>
                        @endif
                        @endauth
                        @guest
                        <li class="nav-item " >
                        <a href="{{url('job_seeker/index')}}" class="nav-link"><i class="fas fa-home"></i>home</a>
                        </li>
                        {{-- <li class="nav-item " >
                            <a href="" class="nav-link"><i class="far fa-address-card"></i>à propos </a>
                        </li> --}}
                        <li class="nav-item " >
                            <a href="/politique-de-confidentalité" class="nav-link"><i class="fas fa-file-contract"></i>politique de confidentialité</a>
                        </li>
                        <li class="nav-item " >
                            <a href="" class="nav-link"><i class="fas fa-blog"></i>blog</a>
                        </li>
                        <li class="nav-item " >
                            <a href="/terme-et-conditions" class="nav-link"><i class="fas fa-file-signature"></i>termes et conditions</a>
                        </li>
                        {{-- <li class="nav-item " >
                            <a href="" class="nav-link"><i class="far fa-copy"></i>pricing</a>
                        </li> --}}
                        {{-- <li class="nav-item " >
                            <a href="" class="nav-link"><i class="far fa-copy"></i>faq</a>
                        </li> --}}
                        <div>
                            <li class="nav-item switch-item" >
                                <a href="{{ url('job_seeker/login')}}" class="nav-link {{ Request::segment(1) === 'job_seeker' ? 'active' : null }}"></i>candidat</a>

                            </li>
                            <li class="nav-item switch-item" >
                                <a href="{{ url('employer/login')}}" class="nav-link {{ Request::segment(1) === 'employer' ? 'active' : null }}"></i>recruteur</a>
                            </li>
                        </div>
                        @endguest
                    </ul>
                </div>
            </nav>

        </div>
        <main class="py-4">
            @yield('content')
            @yield('terme')
        </main>

    </div>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  {{-- <script src="{{asset('js/jquery.js')}}"></script> --}}

  

    <script src="{{asset('js/select2.js') }}" ></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/skill.bars.jquery.js') }}" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$("#news-slider").owlCarousel({
        items : 2,
        itemsDesktop : [1199,2],
        itemsMobile : [600,1],
        pagination :true,
        autoPlay : true
    });

</script>

<script>

// $(".segment-select").Segment();

 </script>
<script src="{{asset('js/menu_js.js')}}">

</script>

</body>
</html>
