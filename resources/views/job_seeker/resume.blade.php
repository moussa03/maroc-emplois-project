
@extends('job_board_layout.app')
@section('content')
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
            <a class="dropdown-item p-0 " href="{{route('job_seeker/resume',$job_seeker_id)}}">
                <li class="p-3 {{ Request::segment(2) === 'resume'? 'active' : null }}"> <span><i class="far fa-calendar-alt"></i>
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
                <a class="dropdown-item p-0" href="{{route('job_seeker/show_resumé',['username' => $job_seeker->username, 'id' => $job_seeker_id])}}">
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
                    <div class="container">
                        <span class="page-title font">
                            <h2 class="font-weight-bold"> publier mon résumé</h2>
                            {{-- <div class="d-lg-none d-xl-none">
                                @component('layouts.components.navbar_small_device')
                                @endcomponent
                            </div> --}}
                        </span>
                    </div>

                    <div class="container">
                        <p id="education" class=" font-weight-bold mt-3">Education</p>
                    <form method="POST" enctype="multipart/form-data" action="{{route('job_seeker/resume_info',$job_seeker_id)}}" >
                        @csrf
                            <div class="cv-attachemenet">
                                <p>cv attachement</p>
                                <label class="btn-bs-file btn btn-primary">
                                    télecharger cv
                                    <input type="file" class=" btn-primary" name="cv"  />
                                </label>
                            </div>

                      <div class="btn-group col-xl-12 p-0 mb-3 ">
                        <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> diplome 1
                        </button>
                        <div class="dropdown-menu resume m-0">

                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom de diplome</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                        <input type="text"  class="educaion-title mb-2 @error('diplome_name_1') is-invalid @enderror" name="diplome_name_1"
                                     {{-- value="{{$education1->diplome_name}}" --}}
                                     value="{!! !empty($education1->diplome_name) ? $education1->diplome_name : '' !!}"
                                     placeholder="ex:technicien spécialisé">
                                     @error('diplome_name_1')
                                     <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    </div>

                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom d'etablissement</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                            class="educaion-title mb-2 @error('school_name_1') is-invalid @enderror" name="school_name_1"
                                             {{-- value="{{$education1->school_name}}" --}}
                                             value="{!! !empty($education1->school_name) ? $education1->school_name : '' !!}"
                                             placeholder="ex:ista"
                                            >
                                            @error('school_name_1')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> description</div>
                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                class="educaion-title mb-2 @error('description_1') is-invalid @enderror" name="description_1"
                                                 {{-- value="{{$education1->school_name}}" --}}
                                                 value="{!! !empty($education1->description) ? $education1->description : '' !!}"
                                                 placeholder="ex:lorem lorem lorem"
                                                >
                                                @error('description_1')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> date</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                        <input type="date" class="educaion-title mb-2 @error('diplome_date_1') is-invalid @enderror" name="diplome_date_1"
                                         {{-- value="{{$education1->diplome_date}}"  --}}
                                         value="{!! !empty($education1->diplome_date) ? $education1->diplome_date : '' !!}"
                                         placeholder="ex:12/12/2002"
                                        />
                                        @error('diplome_date_1')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="btn-group col-xl-12 p-0 mb-3 ">
                        <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> diplome 2
                        </button>
                        <div class="dropdown-menu resume m-0">

                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom de diplome</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                    class="educaion-title mb-2 @error('diplome_name_2') is-invalid @enderror" name="diplome_name_2"
                                    placeholder="ex:technicien spécialisé"
                                     value="{!! !empty($education2->diplome_name) ? $education2->diplome_name : '' !!}"
                                    >
                                    @error('diplome_name_2')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                   @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom d'etablissement</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                            class="educaion-title mb-2 @error('school_name_2') is-invalid @enderror" name="school_name_2"
                                            placeholder="ex:ista"
                                             {{-- value="{{$education2->school_name}}" --}}
                                             value="{!! !empty($education2->school_name) ? $education2->school_name : '' !!}"
                                            >
                                            @error('school_name_2')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> description</div>
                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                class="educaion-title mb-2 @error('description_2') is-invalid @enderror" name="description_2"
                                                 {{-- value="{{$education1->school_name}}" --}}
                                                 value="{!! !empty($education1->description) ? $education1->description : '' !!}"
                                                 placeholder="ex:lorem lorem lorem"
                                                >
                                                @error('description_2')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> date</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                        <input type="date" class="educaion-title mb-2 @error('diplome_date_2') is-invalid @enderror" name="diplome_date_2"

                                         {{-- value="{{$education2->diplome_date}}" --}}
                                         value="{!! !empty($education2->diplome_date) ? $education2->diplome_date : '' !!}"
                                        />
                                        @error('diplome_date_2')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="btn-group col-xl-12 p-0 mb-3 ">
                        <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> diplome 3
                        </button>
                        <div class="dropdown-menu resume m-0">

                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom de diplome</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                        <input type="text"  class="educaion-title mb-2 @error('diplome_name_3') is-invalid @enderror" name="diplome_name_3"
                                        value="{!! !empty($education3->diplome_name) ? $education3->diplome_name : '' !!}"
                                         placeholder="ex:technicien spécialisé "
                                        >
                                        @error('diplome_name_3')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                       @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom d'etablissement</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                            class="educaion-title mb-2 @error('school_name_3') is-invalid @enderror" name="school_name_3"
                                            placeholder="ex:ista"
                                            value="{!! !empty($education3->school_name) ? $education3->school_name : '' !!}"
                                             >
                                             @error('school_name_3')
                                             <div class="alert alert-danger mt-1">{{ $message }}</div>
                                             @enderror
                                    </div>
                                </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> description</div>
                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                class="educaion-title mb-2 @error('description_3') is-invalid @enderror" name="description_3"
                                                 {{-- value="{{$education1->school_name}}" --}}
                                                 value="{!! !empty($education1->description) ? $education1->description : '' !!}"
                                                 placeholder="ex:lorem lorem lorem"
                                                >
                                                @error('description_3')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                        </div>
                                 </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> date</div>
                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                        <input type="date" class="educaion-title mb-2 @error('diplome_date_3') is-invalid @enderror" name="diplome_date_3"

                                        value="{!! !empty($education3->diplome_date) ? $education3->diplome_date : '' !!}"
                                        />
                                        @error('diplome_date_3')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                    </div>
                        @if ($message = Session::get('education'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">sauvegarder eduction</button>
                    </form>
                    </div>

                    <div class="container">
                        <p class=" font-weight-bold mt-3">Experience</p>
                    <form  method="POST"  action="{{route('job_seeker/experience',$job_seeker_id)}}">
                        @csrf
                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> Experience 1
                            </button>
                            <div class="dropdown-menu resume m-0">
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-6"> nom de poste</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-6"><input type="text"
                                                    class="educaion-title mb-2 @error('poste_name_1') is-invalid @enderror" name="poste_name_1"
                                                    value="{!! !empty($experience1->poste_name) ? $experience1->poste_name : '' !!}">
                                                    @error('poste_name_1')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror

                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> nom de societé</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6"><input type="text"
                                                    class="educaion-title mb-2 @error('entreprise_name_1') is-invalid @enderror" name="entreprise_name_1"
                                                    value="{!! !empty($experience1->entreprise_name) ? $experience1->entreprise_name : '' !!}"
                                                    >
                                                    @error('entreprise_name_1')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                                <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> description</div>
                                                <div class="col-9 col-sm-9 col-lg-6 col-xl-6"><input type="text"
                                                        class="educaion-title mb-2 @error('description_1') is-invalid @enderror" name="description_1"
                                                        value="{!! !empty($experience1->description) ? $experience1->description : '' !!}"
                                                        >
                                                        @error('description_1')
                                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                        </div>

                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> start date</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6">
                                                <input type="date" class="educaion-title mb-2 @error('start_date_1') is-invalid @enderror" name="start_date_1"
                                                value="{!! !empty($experience1->start_date) ? $experience1->start_date : '' !!}"
                                                >
                                                @error('start_date_1')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> end date</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6">
                                                <input type="date" class="educaion-title mb-2 @error('end_date_1') is-invalid @enderror" name="end_date_1"
                                                value="{!! !empty($experience1->end_date) ? $experience1->end_date : '' !!}"
                                                                                                />
                                               @error('end_date_1')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                            </div>
                        </div>

                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> Experience 2
                            </button>
                            <div class="dropdown-menu resume m-0">
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-6"> nom de poste</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-6"><input type="text"
                                                    class="educaion-title mb-2 @error('poste_name_2') is-invalid @enderror" name="poste_name_2"
                                                    value="{!! !empty($experience2->poste_name) ? $experience2->poste_name : '' !!}"
                                                    >
                                                    @error('poste_name_2')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> nom de societé</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6"><input type="text"
                                                    class="educaion-title mb-2  @error('entreprise_name_2') is-invalid @enderror" name="entreprise_name_2"
                                                    value="{!! !empty($experience2->entreprise_name) ? $experience2->entreprise_name : '' !!}"
                                                    >
                                                    @error('entreprise_name_2')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                                <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> description</div>
                                                <div class="col-9 col-sm-9 col-lg-6 col-xl-6"><input type="text"
                                                        class="educaion-title mb-2 @error('description_2') is-invalid @enderror" name="description_2"
                                                        value="{!! !empty($experience2->description) ? $experience2->description : '' !!}"
                                                        >
                                                        @error('description_2')
                                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> start date</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6">
                                                <input type="date" class="educaion-title mb-2 @error('start_date_2') is-invalid @enderror" name="start_date_2"
                                                value="{!! !empty($experience2->start_date) ? $experience2->start_date : '' !!}"
                                                >
                                                @error('start_date_2')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-6 col-xl-6"> end date</div>
                                            <div class="col-9 col-sm-9 col-lg-6 col-xl-6">
                                                <input type="date" class="educaion-title mb-2 @error('end_date_2') is-invalid @enderror" name="end_date_2"
                                                value="{!! !empty($experience2->end_date) ? $experience2->end_date : '' !!}"
                                                />
                                                @error('end_date_2')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>


                            </div>
                        </div>
                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> Experience 3
                            </button>
                            <div class="dropdown-menu resume m-0">

                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom de poste</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                    class="educaion-title mb-2 @error('poste_name_3') is-invalid @enderror" name="poste_name_3"
                                                    value="{!! !empty($experience3->poste_name) ? $experience3->poste_name : '' !!}"
                                                    >
                                                    @error('poste_name_3')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom de societé</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                    class="educaion-title mb-2 @error('entreprise_name_3') is-invalid @enderror" name="entreprise_name_3"
                                                    value="{!! !empty($experience3->entreprise_name) ? $experience3->entreprise_name : '' !!}"
                                                    >
                                                    @error('entreprise_name_3')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                                <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> description</div>
                                                <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                        class="educaion-title mb-2 @error('description_3') is-invalid @enderror" name="description_3"
                                                        value="{!! !empty($experience3->description) ? $experience3->description : '' !!}"
                                                        >
                                                        @error('description_3')
                                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                            </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> start date</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                                <input type="date" class="educaion-title mb-2 @error('start_date_3') is-invalid @enderror" name="start_date_3"
                                                value="{!! !empty($experience3->start_date) ? $experience3->start_date : '' !!}"
                                                />
                                                @error('start_date_3')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> end date</div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                                <input type="date" class="educaion-title mb-2 @error('end_date_3') is-invalid @enderror" name="end_date_3"
                                                value="{!! !empty($experience3->end_date) ? $experience3->end_date : '' !!}"
                                                />
                                                @error('end_date_3')
                                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                            </div>
                        </div>
                        @if ($message = Session::get('experience'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">sauvegarder expérience</button>
                    </form>
                    </div>

                    <div class="container">
                        <p id="education" class=" font-weight-bold mt-3"> skills</p>
                       <form action="{{route('job_seeker/skills',$job_seeker_id)}}" method="POST">
                        @csrf
                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> compétence 1
                            </button>
                            <div class="dropdown-menu resume m-0">

                                    <div class="form-group d-flex justify-content-center align-items-center ">
                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom</div>
                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                        class="educaion-title mb-2 @error('skill_name_1') is-invalid @enderror" name="skill_name_1"
                                        value="{!! !empty($skill1->Name) ? $skill1->Name : '' !!}"
                                        >
                                        @error('skill_name_1')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                <div class="form-group d-flex justify-content-center align-items-center ">
                                            <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> <p>Value: <span id="demo_1"></span></p></div>
                                            <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                                    <div class="slidecontainer">
                                                    <input type="range" min="1" max="100"
                                                    value="{!! !empty($skill1->performance) ? $skill1->performance : '' !!}"
                                                    class="slider" id="myRange_1" name="skill_1">
                                                    </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> compétence 2
                            </button>
                            <div class="dropdown-menu resume m-0">

                                                <div class="form-group d-flex justify-content-center align-items-center ">
                                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom</div>
                                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                            class="educaion-title mb-2 @error('skill_name_2') is-invalid @enderror"
                                                            name="skill_name_2"
                                                            value="{!! !empty($skill2->Name) ? $skill2->Name : '' !!}"
                                                            >
                                                            @error('skill_name_2')
                                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex justify-content-center align-items-center ">
                                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> <p>Value: <span id="demo_2"></span></p></div>
                                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                                                <div class="slidecontainer">
                                                                <input type="range" min="1" max="100"
                                                                value="{!! !empty($skill2->performance) ? $skill2->performance : '' !!}"
                                                                class="slider" id="myRange_2" name="skill_2">

                                                                </div>
                                                        </div>
                                                 </div>
                            </div>
                        </div>
                        <div class="btn-group col-xl-12 p-0 mb-3 ">
                            <button type="button" class="btn btn-secondary dropdown-toggle toggle-resume"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('img/close.png')}}" class="close-icon" alt=""> compétence 3
                            </button>
                            <div class="dropdown-menu resume m-0">

                                                <div class="form-group d-flex justify-content-center align-items-center ">
                                                    <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> nom</div>
                                                    <div class="col-9 col-sm-9 col-lg-9 col-xl-9"><input type="text"
                                                            class="educaion-title mb-2 @error('skill_name_3') is-invalid @enderror" name="skill_name_3"
                                                            value="{!! !empty($skill3->Name) ? $skill3->Name : '' !!}"
                                                            >
                                                            @error('skill_name_3')
                                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex justify-content-center align-items-center ">
                                                        <div class="col-3 col-sm-3 col-lg-3 col-xl-3"> <p>Value: <span id="demo_3"></span></p></div>
                                                        <div class="col-9 col-sm-9 col-lg-9 col-xl-9">
                                                                <div class="slidecontainer">
                                                                        <input type="range" min="1" max="100"
                                                                        value="{!! !empty($skill3->performance) ? $skill3->performance : '' !!}"
                                                                        class="slider" id="myRange_3" name="skill_3">

                                                                </div>
                                                        </div>
                                                 </div>

                            </div>
                        </div>
                        @if ($message = Session::get('skills'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">sauvegarder compétences</button>
                    </form>
                    </div>


                </div>
                <script src="{{ asset('js/custom.js') }}" defer></script>
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
