
@extends('job_board_layout.app')
@section('content')
    <div class="container-fluid overflow-hidden p-0">
            @if ($updated = Session::get('updated'))
            <div class="alert alert-success alert-block mb-0 text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $updated }}</strong>
            </div>
            @endif
        <div class="row">
                @component('layouts.components.side_navbar')
                @slot('dashboard')
                <a  href="{{route('employer/dashboard',$employer)}}">
                    <li class="p-3"><span><i class="fa fa-th-large"></i></span>   tableau de bord</li>

                @endslot
                @slot('profile')
                <a class="dropdown-item p-0" href="{{route('employer/profile',$employer_id)}}">
                    <li class="p-3 {{ Request::segment(2) === 'profile'? 'active' : null }}">
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
                <a class="dropdown-item p-0" href="{{route('employer/my_jobs',$employer)}}">
                <li class="p-3"> <span><i class="far fa-clone"></i>
                </span> mes offres</li>
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
                <div class="col-lg-9 col-xl-9 profile-content">
                    <div>
                        <span class="page-title font">
                            <h2 class="font-weight-bold"> profile</h2>
                             {{-- <div class="d-lg-none d-xl-none">
                                    @component('layouts.components.navbar_small_device')
                                    @endcomponent
                             </div> --}}
                        </span>
                    </div>
                    <div class="profile-form mt-5 container">
                      <div class="profile-logo">
                      <form method="POST" enctype="multipart/form-data" action="{{route('profile.update',$employer)}}">
                        @csrf
                        <div class="cv-attachemenet">
                            <p>fiche d'entreprise</p>
                            <label class="btn-bs-file btn btn-primary">
                                télécharger fiche
                                <input type="file" class=" btn-primary" name="fiche"  />
                            </label>
                        </div>
                            <div class="job_offer_header">
                                    <div class="job_offer_title col-lg-6">
                                    <label for="exampleInputEmail1" class="p-2">prénom</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="prénom" value={{$employer->username}} />
                                            @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                    <div class="job_offer_type col-lg-6">
                                        <label for="exampleInputEmail1" class="p-2">catégorie</label>
                                        <select name="categorie" class="custom-select mr-sm-2 @error('category Name') is-invalid @enderror" id="inlineFormCustomSelect">
                                        <option value="0" selected disabled>choisir categorie</option>
                                        @foreach ($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->Name}}</option>

                                        @endforeach
                                        </select>
                                        @error('category Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                       @enderror
                                    </div>

                                </div>
                                {{-- <div class="container">

                                </div> --}}
                                <div class="job_offer_header">
                                    <div class="job_offer_title col-lg-6">
                                    <label for="exampleInputEmail1" class="p-2">photo de profile</label>
                                    <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                              <input type="file"  name="profile_picture" class="custom-file-input @error('profile_picture') is-invalid @enderror" id="inputGroupFile01">
                                              @error('profile_picture')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                             @enderror
                                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>

                                          </div>

                                    </div>
                                    <div class="job_offer_type col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">email</label>
                                            <input name="email" type="text" class="form-control  " id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="prénom" value={{$employer->email}} />
                                                @error('email')
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
                                    rows="3" >{{$employer->description}}</textarea>
                                    @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror
                                    </div>
                                </div>

                            </div>


                                <div class="job_offer_header">
                                        <div class="job_offer_title col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">num de tél</label>
                                            <input name="offer_title" type="text" class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="06/07 53 87 5632" />
                                                @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                        <div class="job_offer_type col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">nombre des employés</label>
                                            <select name="team_mebers_value" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            <option value="0" selected disabled>choisir nombre des employés</option>
                                            @foreach ($team_members as $team_member)
                                            <option value="{{$team_member->id}}" >{{$team_member->team_members}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                </div>

                                    <div class="job_offer_header">
                                            <div class="job_offer_title col-lg-6">
                                                <label for="exampleInputEmail1" class="p-2">site web</label>
                                                <input name="offer_title" type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="amarapus.com" value={{$employer->website}}>
                                            </div>
                                            <div class="job_offer_type col-lg-6">
                                                <label for="exampleInputEmail1" class="p-2">ville</label>
                                                <select name="city" class="custom-select mr-sm-2 @error('location Name') is-invalid @enderror" id="inlineFormCustomSelect">
                                                <option value="0" disabled selected>choisir  ville</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->id}}">{{$location->Name}}</option>
                                                @endforeach

                                                </select>
                                                @error('location Name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="job_offer_header">
                                        <div class="job_offer_title col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">age</label>
                                            <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="25" value={{$employer->age}}>
                                                @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                        <div class="job_offer_type col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">sexe</label>
                                            <select class="custom-select" name="gender">
                                                <option value="0" selected disabled>choisir sexe</option>
                                                <option value="male">male</option>
                                                <option value="femme">femme</option>
                                            </select>
                                            </select>
                                        </div>
                                </div>

                                        <div class="container">


                                    <input class="btn btn-primary mt-3" type="submit" value="Save profile">
                                    </div>

                          </form>
                      </div>
                    </div>
                </div>
        </div>
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
    @component('layouts.components.footer')

    @endcomponent
 @endsection
