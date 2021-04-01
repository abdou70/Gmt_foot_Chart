<!-- @extends('layouts.template')
@include('layouts.nav')
@section('content')
<div class="row mt">
    <div class="col-md-12 P-1">
        <a type="button" class="btn btn-theme" href="{{ route('getallproduit') }}">
            liste des produits
        </a>
    </div>
</div>
<div class="row mt">
    <div class="col-lg-12">
        <h4><i class="fa fa-angle-right"></i>{{ __('Ajouter  produit') }}</h4>
        <div class="form-panel">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (isset($confirmation))

            @if($confirmation ==1)
            <div class="alert alert-success">Produit ajouté</div>
            @else
            <div class="alert alert-danger">Produit non ajouter </div>
            @endif

            @endif
            <form method="POST" action="{{ route('ajouterproduit') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nomproduit" class="control-label"> Nom Produit :</label>
                    <input type="text" name="nomproduit" id="nomproduit" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="referenceproduit" class="control-label"> Reference Produit :</label>
                    <input type="text" name="referenceproduit" id="referenceproduit" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="quantiteproduit" class="control-label"> Quantite Produit :</label>
                    <input type="text" name="quantiteproduit" id="quantiteproduit" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="prixproduit" class="control-label">Prix Produit :</label>
                    <input type="text" name="prixproduit" id="prixproduit" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="photo" class="control-label">Photo du produit</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" for="id_categorie"> ID-Categorie </label><strong>*</strong>
                    <select class="form-control" name="id_categorie" id="id_categorie">
                        <option value="">Choisir categorie</option>
                        @foreach($les_categorie as $categorie)
                        <option value="{{$categorie->id}}">
                            {{$categorie->libelle}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="envoyer" id="envoyer" value="Enregistrer" class="btn btn-success" />
                    <input type="reset" name="annuler" id="annuler" value="annuler" class="btn btn-danger" />
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@include('layouts.footer') -->