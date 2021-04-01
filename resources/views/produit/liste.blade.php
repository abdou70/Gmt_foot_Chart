@extends('layouts.template')
@include('layouts.nav')
@section('content')
<!-- {{-- Start-Add-Modal--}} -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mt">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajout produit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('ajouterproduit') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomproduit" class="control-label"> Nom Produit :</label>
                        <input type="text" name="nomproduit" id="nomproduit" class="form-control" />
                    </div>

                    <!--   <div class="form-group">
                        <label for="referenceproduit" class="control-label"> Reference Produit :</label>
                        <input type="text" name="referenceproduit" id="referenceproduit" class="form-control" />
                    </div>
                    -->
                    <!--   <div class="form-group">
                        <label for="quantiteproduit" class="control-label"> Quantite Produit :</label>
                        <input type="text" name="quantiteproduit" id="quantiteproduit" class="form-control" />
                    </div> -->

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
                            @foreach($les_categorie as $categorie)
                            <option value="{{$categorie->id}}">
                                {{$categorie->libelle}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="envoyer" id="envoyer" value="Enregistrer" class="btn btn-theme" />
                        <input type="reset" name="annuler" id="annuler" value="annuler" class="btn btn-danger" />
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- {{-- End Add Modal--}} -->
<!-- {{-- End Edit Modal--}} -->


<div class="mt">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <button type="button" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal">
        Ajouter une produit
    </button>

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Liste des Catégories</h4>
                    <hr>
                    <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Nom du Produit</th>
                            <th>Photo produit</th>
                            <th>Categorie Produit</th>
                            <th>Prix du Produit</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                        @foreach($liste_produit as $produit)
                        <tr>
                            <td>{{ $produit->reference }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td> <img src="{{ $produit->photo }}" width="50" height="50"></td>
                            <td>{{\App\Categorie::find($produit->categorie_id)->libelle }}</td>
                            <td>{{ $produit->prix }}</td>
                            <td><a class="btn btn-theme" href="{{ route('editproduit' , ['id' => $produit->id]) }}">Editer</a></td>
                            <td><a class="btn btn-danger" href="{{ route('deleteproduit' , ['id' => $produit->id]) }}" onclick="return confirm('Voulez-vous supprimer le produit?')" ;>Supprimer</a></td>
                        </tr>
                        @endforeach
                </table>
                   {{ $liste_produit->links() }}
            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-md-12 -->
    </div>
    <!-- /row -->
</div>
@endsection

@include('layouts.footer')