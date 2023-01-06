
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
            <a href="{{route('job_seeker/dashboard',$job_seeker_id)}}">
                <li class="p-3"><span><i class="fa fa-th-large"></i></span>   tableau de bord</li>
            </a>
            @endslot
                @slot('profile')
                <a href="{{route('job_seeker/profile',$job_seeker_id)}}" class="dropdown-item p-0">
                <li class="p-3 {{ Request::segment(2) === 'my_profile'? 'active' : null }}"> <span><i class="fa fa-user"></i></span> profile</li>

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
                        <li class="p-3"> <span><i class="far fa-clone"></i>
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

                    <a class="dropdown-item p-0" href="{{ route('logout') }}"
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
                    <li class="p-3 text-danger" id="myBtn" class="dropdown-item">
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
                            <h2 class="font-weight-bold"> profile</h2>
                             {{-- <div class="d-lg-none d-xl-none">
                                    @component('layouts.components.navbar_small_device')
                                    @endcomponent
                             </div> --}}
                        </span>
                    </div>
                    <div class="profile-form mt-5 container">
                      <div class="profile-logo">
                      <form method="POST" enctype="multipart/form-data" action="{{route('job_seeker/profile.update',$job_seeker_id)}}">
                        @csrf
                            <div class="job_offer_header">
                                    <div class="job_offer_title col-lg-6">
                                    <label for="exampleInputEmail1" class="p-2">prénom</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="prénom" value={{$job_seeker->username}} />
                                            @error('username')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                            @enderror
                                    </div>

                                    <div class="job_offer_type col-lg-6">
                                        <label for="exampleInputEmail1" class="p-2">catégorie</label>
                                        <select name="category_id" class="custom-select mr-sm-2 @error('category Name') is-invalid @enderror" id="inlineFormCustomSelect">
                                         <option value="0" disabled selected>Nom de catégorie</option>
                                        @foreach ($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->Name}}</option>

                                        @endforeach
                                        </select>
                                        @error('category Name')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
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
                                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            </div>
                                         @error('profile_picture')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="job_offer_type col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">email</label>
                                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                                                aria-describedby="emailHelp" placeholder="email" value={{$job_seeker->email}} />
                                        @error('email')
                                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="job_offer_desc col-lg-12">
                                    <div class="">
                                        <label for="exampleFormControlTextarea1" class="p-2">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1"
                                    rows="3" >{{$job_seeker->description}}</textarea>
                                    @error('description')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                   @enderror
                                    </div>
                                </div>

                            </div>

                                <div class="job_offer_header">
                                        <div class="job_offer_title col-lg-6">
                                            <label for="exampleInputEmail1" class="p-2">num de tél</label>
                                            <input name="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="06/07 53 87 5632" value="{{$job_seeker->phone_number}}" />
                                        @error('phone_number')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                       @enderror
                                        </div>
                                        <div class="job_offer_title col-lg-6">
                                                <label for="exampleInputEmail1" class="p-2"> age </label>
                                                <input name="age" type="text" class="form-control @error('age') is-invalid @enderror" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="25"
                                                    value={{$job_seeker->age}}
                                                    >
                                                    @error('age')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                   @enderror
                                            </div>

                                </div>
                                    <div class="job_offer_header">
                                            <div class="job_offer_title col-lg-6">
                                                <label for="exampleInputEmail1" class="p-2">site web</label>
                                                <input name="website" type="text" class="form-control @error('website') is-invalid @enderror" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="amarapus.com" value={{$job_seeker->website}}>
                                                    @error('website')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                   @enderror
                                            </div>
                                            <div class="job_offer_type col-lg-6">
                                                <label for="exampleInputEmail1" class="p-2">location</label>

                                                <select name="location_id" class="custom-select mr-sm-2 @error('location Name') is-invalid @enderror" id="inlineFormCustomSelect">
                                                 <option value="0" disabled selected>Ville</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->id}}">{{$location->Name}}</option>
                                                @endforeach

                                                </select>
                                                  @error('location Name')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                   @enderror

                                            </div>
                                    </div>
                                    <div class="job_offer_header mt-3">
                                            <div class="job_offer_title col-lg-12 @error('gender') is-invalid @enderror">
                                                <select class="custom-select" name="gender">
                                                    <option value="0" disabled selected> sex</option>
                                                    <option value="male">male</option>
                                                    <option value="femme">femme</option>
                                                </select>
                                                @error('gender')
                                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                                   @enderror
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',  // change this value according to the HTML
             toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
             plugins: "link lists",
             toolbar: "numlist bullist"

          });

        </script>
@component('layouts.components.footer')

@endcomponent
 @endsection
