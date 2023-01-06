    <div class=" offset-xs-1 offset-sm-1 offset-md-1 offset-lg-1"></div>
    <div class="card col-5 col-sm-5 col-md-5 col-lg-5">
        <form method="POST" action="{{ route('employer.register') }}" enctype="multipart/form-data">
            @csrf
            <div class="wrap">
                <div class="form-group row">
                    <input id="username" type="text" placeholder="Username" autofocus
                        class=" form-control login-input @error('username') is-invalid @enderror" name="username"
                        value="{{ old('username') }}">
                    <label for="username"></label>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    {{-- <p class="help is-ivalid ">{{$errors->first('username')}}</p> --}}
                </div>
                <div class="form-group row">
                    <input  placeholder="email" type="email"
                        class="login-input form-control @error ('email') is-invalid @enderror" name="email"
                        value="{{old('email')}}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <input type="password" placeholder="Mot de passe"
                        class="login-input form-control @error('password') is-invalid @enderror" name="password"
                        required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <input type="password" placeholder="Confirmer  Mot de passe" class="login-input form-control"
                        name="password_confirmation" required>
                </div>
                <div class="form-group row">
                    <select name="location_id"  class="grid form-control @error('location') is-invalid @enderror" required="required">
                        <option value="0" disabled selected>choose location</option>
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
                <div class="form-group row">
                    <select name="category_id"  class="grid form-control @error('category') is-invalid @enderror">
                        <option value="0" selected disabled>choose catagorie</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->Name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                 <div class="form-group">
                     <input type="text" class="login-input form-control row @error('entreprise_name') is-invalid @enderror" name="entreprise_name" value="{{old('entreprise_name')}}" placeholder="entreprise_name">
                     @error('entreprise_name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                 </div>
                 {{-- <div class="job_offer_title col-lg-6">
                    <label for="exampleInputEmail1" class="p-2">photo de profile</label>
                     <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Upload</span>
                            </div>
                            <div class="custom-file">
                              <input type="file"  name="profile_picture" class="custom-file-input" id="inputGroupFile01">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                    </div>
                    </div> --}}
                <input type="submit" value="Sign Up" class="login-input">

                {{-- <div class="separator">
                    <span class="divider">or</span>
                    <span class="sep"></span>
                </div>
                <div class="social-login">
                    <p class="social-button">
                        <a class="facebook-before"><span class="fontawesome-facebook"></span></a>
                        <button class="facebook">login Using Facbook</button>
                    </p>
                    <p class="social-button">
                        <a class="twitter-before"><span class="fontawesome-twitter"></span></a>
                        <button class="twitter">login Using Twitter</button>
                    </p>
                </div> --}}
            </div>
        </form>
    </div>
</div>
