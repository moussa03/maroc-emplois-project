@extends('job_board_layout.app')
@section('content')
<div class="container-fluid overflow-hidden p-0 register_job_offer">

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
                <li class="p-3 {{ Request::segment(2) === 'register_job_offer'? 'active' : null }}"> <span><i class="far fa-calendar-alt"></i>
                </span> publier une annonce</li>
                </a>
                @endslot
                @slot('single_page')
                <a class="dropdown-item p-0" href="{{route('employer/details',$employer_id)}}">
                    <li class="p-3"> <span><i class="fas fa-receipt"></i>
                    </span> détails</li>
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
                @slot('jobs')
                <a class="dropdown-item p-0" href="{{route('employer/my_jobs',$employer_id)}}">
                <li class="p-3"> <span><i class="far fa-clone"></i>
                </span> mes offres</li>
                </a>
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
                    {{-- <div class="d-lg-none d-xl-none">
                        @component('layouts.components.navbar_small_device')

                        @endcomponent
                    </div> --}}
                    <form method="POST" action="{{route('register.job_offer')}}" enctype="multipart/form-data"
                        class="col-lg-9 col-xl-9">
                        @csrf

                        <div class="job_offer_header">
                            <div class="job_offer_title col-lg-6">
                                <label for="exampleInputEmail1" class="p-2">titre d'annonce</label>
                                <input name="offer_title" type="text" class="form-control @error('offer_title') is-invalid @enderror" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="titre d'annonce" />
                                    @error('offer_title')
                                    
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="job_offer_type col-lg-6">
                                <label for="exampleInputEmail1" class="p-2">type d'emploi</label>
                                <select name="type_emploi" class="custom-select mr-sm-2 @error('type_emploi') is-invalid @enderror" id="inlineFormCustomSelect">
                                    <option value="0" selected disabled>type d'emplois</option>
                                    <option value="temps-plein">Temps plein</option>
                                    <option value="partiel">Partiel</option>
                                    <option value="cdi">Cdi</option>
                                    <option value="stage">Stage</option>
                                    <option value="cdd">Cdd</option>
                                </select>
                                @error('type_emploi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="job_offer_desc col-lg-12">
                            <div class="">
                                <label for="exampleFormControlTextarea1" class="p-2">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>

                        <div class="job_offer_salary col-lg-12 mt-3">

                            <select name="categorie" class="custom-select mr-sm-2 @error('categorie') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="0" disabled selected>catégorie</option>
                                @foreach ($categories as $categorie)
                                <option value="{{$categorie->id}}">{{$categorie->Name}}</option>
                                @endforeach


                            </select>
                            @error('categorie')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class=" job_ofer_img col-12 col-sm-6 col-md-6 col-lg-6 ">
                            <label for="" class="mb-3">ajouter image</label>
                            <div class="input-group mb-3 btn-light ">

                                <div class="custom-file">
                                    <input name="offer_image" type="file" class="custom-file-input  @error('offer_image') is-invalid @enderror"
                                        id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        @error('offer_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    <label class="custom-file-label" for="inputGroupFile01">telecharger image</label>
                                </div>
                            </div>
                        </div>

                        <div class="job_offer_salary col-lg-12">
                            <select name="salary" class="custom-select mb-2 mr-sm-2 @error('salary') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="0" selected disabled> salaire </option>
                                @foreach ($salaries as $salary)
                                <option value="{{$salary->id}}">{{$salary->Name}}</option>
                                @endforeach

                            </select>
                            @error('salary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="job_offer_location col-lg-12">
                            <select name="location" class="custom-select mb-2 mr-sm-2 @error('location') is-invalid @enderror" id="inlineFormCustomSelect">
                                <option value="0" disabled selected> ville</option>
                                @foreach ($locations as $location)

                                <option value="{{$location->id}}">{{$location->Name}}</option>
                                @endforeach
                            </select>
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="job_offer_experience mb-3 col-lg-12">
                            <select name="experience" class="custom-select mr-sm-2 mb-2" id="inlineFormCustomSelect">
                                <option value="0" selected disabled> experience</option>
                                @foreach ($experiences as $experience)
                            <option value="{{$experience->id}}">{{$experience->Name}}</option>
                                @endforeach

                            </select>
                        </div>

                        {{-- <input name='tags' placeholder='Movie names' value="madmax,batman" class="mt-3"> --}}
                        <div class="col-lg-12">
                            <label for="">tags</label>
                        <select class="js-example-basic-multiple " name="tags[]" multiple="multiple" >

                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}"> {{$tag->Name}} </option>
                            @endforeach
                        </select>
                    </div>




                    <div class="col-lg-12">
                    <input type="submit" value="publier une annonce" class="login-input mt-4 ">
                    </div>

                    </form>



    </div>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to the HTML
             toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
             plugins: "link lists",
             toolbar: "numlist bullist"

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
</div>
@component('layouts.components.footer')

@endcomponent
@endsection
