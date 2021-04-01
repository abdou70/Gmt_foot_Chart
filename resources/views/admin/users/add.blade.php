<!-- @extends('layouts.template')
@include('layouts.nav')
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <a type="button" class="btn btn-theme" href="{{ route('admin.users.index') }}">
            liste des utilisateurs
        </a>
    </div>
</div>

<div class="row mt">
    <div class="col-lg-12">
        <h4><i class="fa fa-angle-right"></i>{{ __('Inscription utilisateur') }}</h4>
        <div class="form-panel">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom et Prenom') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nom Utilisateur') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>


                <div class="form-group row ">
                    <div class="col-md-4"></div>
                    <div class="col-md-8 ">
                        <button class="btn btn-theme" type="submit"> {{ __('Enregistrer') }}</button>
                        <button class="btn btn-theme04" type="reset">{{ __('Annuler') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>
</div>

@endsection
@include('layouts.footer') -->