<!-- @extends('layouts.template')
@include('layouts.nav')

@section('content')
<div class="row mt">
    <div class="col-md-12 P-1">
        <a type="button" class="btn btn-theme" href="{{ route('admin.profils.index') }}">
            liste des profils
        </a>
    </div>
</div>
<div class="row mt">
    <div class="col-lg-12">
        <h4><i class="fa fa-angle-right"></i>{{ __('Ajouter profil') }}</h4>
        <div class="form-panel">
            <form method="POST" action="{{ route('admin.profils.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Profil') }}</label>

                    <div class="col-md-8">
                        <input id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>

                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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


@endsection
@include('layouts.footer') -->