@extends('layouts.template')

@section('login')

<div id="login-page">
    <div class="container">
      <form class="form-login" action="{{ route('login') }}" method="POST">
      @csrf
        <h2 class="form-login-heading">{{ __('Login') }}</h2>
        <div class="login-wrap">
        <input id="email" placeholder="Votre nom d'utilisateur" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          <br>
          <input placeholder="Votre mot de passe" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
          <label class="checkbox" style="margin-left: 7%;">
          <input type="checkbox" value="remember-me"   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
          </label> 
          <button class="btn btn-theme btn-block " type="submit"><i class="fa fa-lock"></i> Se connecter</button>
      
        </div>
      </form>
    </div>
  </div>
 <!-- js placed at the end of the document so the pages load faster -->
 <script src=" {{ asset('template/lib/jquery/jquery.min.js')}}"></script>
  <script src=" {{ asset('template/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="{{ asset('template/lib/jquery.backstretch.min.js')}}"></script>
  <script>
    $.backstretch(" {{ asset('template/img/login-bg.jpg')}}", {
      speed: 500
    });
  </script>
@endsection
