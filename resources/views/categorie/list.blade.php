@extends('layouts.template')
@include('layouts.nav')

@section('content')
<!-- {{-- Start-Add-Modal--}} -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content mt">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      <form method="POST" action="{{ route('ajoutercategorie') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="nomcategorie" class="control-label"> Nom Categorie :</label>
            <input type="text" onblur="notNumber(this)" name="nomcategorie" id="nomcategorie" class="form-control" />
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
    Ajouter une categorie
  </button>

  <div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">
        <table class="table table-striped table-advance table-hover">
          <h4><i class="fa fa-angle-right"></i> Liste des Catégories</h4>
          <hr>
          <thead>
            <tr>
              <th>#</th>
              <th>libelle Categorie</th>
              <th>Actions</th>

            </tr>
            @foreach($liste_categorie as $categorie)
            <tr>
              <td>{{ $categorie->id }}</td>
              <td>{{ $categorie->libelle }}</td>
              <td>

                <a class="btn btn-primary btn-xs" href="{{ route('editcategorie' , ['id' => $categorie->id]) }}"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger btn-xs" href="{{ route('deletecategorie' , ['id' => $categorie->id]) }}" onclick="return confirm('Voulez-vous vraiement supprimer?')"><i class="fa fa-trash-o "></i></a>
              </td>
            </tr>
            @endforeach
        </table>
           {{ $liste_categorie->links() }} 
      </div>
      <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
  </div>
  <!-- /row -->
  @endsection
  @include('layouts.footer')