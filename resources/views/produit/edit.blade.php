@extends('layouts.template')
@include('layouts.nav')
@section('content')
<div class="row mt">
          <div class="col-lg-12">
            <h4><i class="fa fa-angle-right"></i>{{ __('modifier  produit') }}</h4>
              <div class="form-panel">
                    @if (isset($confirmation))

                        @if($confirmation ==1)
                          <div class="alert alert-success">Produit ajouté</div>
                        @else
                           <div class="alert alert-danger">Produit non ajouter </div>
                        @endif

                    @endif
                    <form method="POST" action="{{ route('updateproduit') }}">
                        @csrf
                   <div class="form-group">
                    <input type="hidden"  readonly="true" name="id" id="id" value="{{ $produit->id }}" class="form-control" />
                    </div>
                   
                    <div class="form-group">
                        <label for="nomproduit" class="control-label"> Nom Produit :</label>
                        <input type="text" name="nomproduit" id="nomproduit" 
                        value="{{ $produit->nom }}"  class="form-control" />
                        </div>
<!-- 
                    <div class="form-group">
                    <label for="adresseclient" class="control-label">Quantite Produit :</label>
                    <input type="text" name="quantiteproduit" id="quantiteproduit" value="{{ $produit->quantite }}" class="form-control" />
                    </div>
              -->
                    <div class="form-group">
                    <label for="prixproduit" class="control-label"> Prix Produit :</label>
                    <input type="tel" name="prixproduit" id="prixproduit" value="{{ $produit->prix }}" class="form-control" />
                    </div>
 
                    <div class="form-group">
                        <label class="form-label" for="id_categorie"> ID-Categorie </label><strong>*</strong>
                        <select class="form-control" name="id_categorie" id="id_categorie">
                            @foreach($les_categorie as $categorie)
                                        <option value="{{$categorie->id}}">
                                            {{$categorie->libelle}}
                                        </option>
                            @endforeach
                        </select>
                    </div>
              
                    <div class="form-group">
                    <input type="submit" name="envoyer" id="envoyer" value="Enregistrer" class="btn btn-success"/>
                    <a class="btn btn-danger" href="{{ route('getallproduit') }}">Annuler</a>
                    </div>
                    </form>
                    </div>
            </div>
            <!-- /form-panel -->
</div>
@endsection
@include('layouts.footer')