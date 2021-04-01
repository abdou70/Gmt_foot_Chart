@extends('layouts.template')
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
            <form method="post" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PATCH')
                @foreach($profils as $profil)
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="profils[]" value="{{$profil->id}}" id="{{$profil->id}}" @if ($user->profils->pluck('id')->contains($profil->id)) checked @endif />
                    <br>
                    <label for="{{$profil->id}}" class="form-check-label"> {{ $profil->status}}</label>
                </div>
       
                @endforeach

                <button class="btn btn-theme">Affecter</button>

            </form>
        </div>
    </div>
    <!-- /form-panel -->
</div>



@endsection
@include('layouts.footer')