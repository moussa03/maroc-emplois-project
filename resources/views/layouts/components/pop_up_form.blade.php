
 <form action="{{route('job_seeker_news_letter.register')}}" method="POST">
    @csrf
        <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body mx-3">
              <div class="md-form mb-5">
                <i class="fas fa-user prefix grey-text"></i>
                <input type="text" id="orangeForm-name" class="form-control validate @error('username') is-ivalid @enderror" name="username"
              value="{{old('username')}}"
                >
                <label data-error="wrong" data-success="right" for="orangeForm-name">Your name</label>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


              </div>
              <div class="md-form mb-5">
                <i class="fas fa-envelope prefix grey-text"></i>
                <input  id="orangeForm-email" class="form-control validate @error('email') is-invalid @enderror" name="email"
                value={{old('email')}}
                >
                <label data-error="wrong" data-success="right" for="orangeForm-email">Your email</label>
                   @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
              </div>

              <div class="md-form mb-4">
                <i class="fas fa-lock prefix grey-text"></i>
                <input type="password" id="orangeForm-pass" class="form-control validate @error('password') @enderror" name="password">
                <label data-error="wrong" data-success="right" for="orangeForm-pass">Your password</label>
              </div>
              <div class="md-form mb-4">
                    <i class="far fa-paper-plane"></i>
                    <input class="login-input" type="submit">

                  </div>
            </div>

            </div>

        </div>

        </div>

 </form>
