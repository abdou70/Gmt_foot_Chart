@extends('layouts.template')
@include('layouts.nav')

@section('content')
<div class="row mt">
          <div class="col-lg-12">
            <h4><i class="fa fa-angle-right"></i>{{ __('Editer categorie') }}</h4>
              <div class="form-panel">
                    @if (isset($confirmation))

                        @if($confirmation ==1)
                          <div class="alert alert-success">Compte ajouté</div>
                        @else
                           <div class="alert alert-danger">Compte non ajouter </div>
                        @endif

                    @endif
                    <form method="POST" action="{{ route('updatecategorie') }}">
                        @csrf
                   <div class="form-group">
                    <!-- <label for="id" class="control-label"> Identifiant du  categorie :</label> -->
                    <input type="hidden"  readonly="true" name="id" id="id" value="{{ $categorie->id }}" class="form-control" />
                    </div>
                   
                    <div class="form-group">
                        <label for="numcompte" class="control-label"> Nom Categorie :</label>
                        <input type="text" name="nomcategorie" id="nomcategorie"  onblur="notNumber(this)"
                        value="{{ $categorie->libelle }}"  class="form-control" />
                        </div>

                    <div class="form-group">
                    <input type="submit" name="envoyer" id="envoyer" value="Enregistrer" class="btn btn-success"/>
                    <a class="btn btn-danger" href="{{ route('getallcategorie') }}">Annuler</a>
                    </div>
                    </form>
                    </div>
            </div>
            <!-- /form-panel -->
</div>
       
@endsection
@include('layouts.footer')
