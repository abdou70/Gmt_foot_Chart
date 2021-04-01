@extends('layouts.template')
@include('layouts.nav')
@section('content')
{{-- <div class="row mt">
    <div class="col-md-12 P-1">
        <a type="button" class="btn btn-theme" href="{{ route('getallcategorie') }}">
liste des Categories
</a>
</div>
</div> --}}
<div class="row mt">
  <div class="col-lg-12">
    <h4><i class="fa fa-angle-right"></i>{{ __('Ajouter reglement') }}</h4>
    <div class="form-panel">
      @if (\Session::has('success'))
      <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}
      </div>
      @endif
      <form method="POST" action="{{ route('ajouterreglement')}}">
        @csrf
        <div class="form-group">
          <label for="nomreglement" class="control-label"> Type_payement :</label>
          <input type="text" name="nomreglement" id="nomreglement" class="form-control" />
        </div>

        <div class="form-group">
          <input type="submit" name="envoyer" id="envoyer" value="Enregistrer" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal" />
          <input type="reset" name="annuler" id="annuler" value="annuler" class="btn btn-danger" />
        </div>
      </form>
    </div>
  </div>
  <!-- /form-panel -->
</div>

@endsection
@include('layouts.footer')