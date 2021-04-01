@extends('layouts.template')
@include('layouts.nav')
@section('content')

<div class="row mt">
    <div class="col-lg-12">
        <h4><i class="fa fa-angle-right"></i>{{ __('Modification de mot de passe') }}</h4>
        <div class="form-panel">
            @if(count($errors) ==1)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <form method="POST" action="{{ route('update-password') }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="old_password" class="col-md-3 col-form-label">{{ __('Mot de passe actuelle') }}</label>
                    <div class="col-md-6">
                        <input id="old_password" name="old_password" type="password" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password" class="col-md-3 col-form-label">{{ __('Nouveau mot de passe') }}</label>
                    <div class="col-md-6">
                        <input id="new_password" name="new_password" type="password" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirm" class="col-md-3 col-form-label">{{ __('Confirmer le mot de passe ') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirm" name="password_confirm" type="password" class="form-control" required autofocus>
                    </div>
                </div>
                <div class="form-group login-row row mb-0">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="btn btn-theme">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
</div>
@endsection
@include('layouts.footer')