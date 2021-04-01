@extends('layouts.template')
@include('layouts.nav')
@section('content')
<!-- {{-- Start-Add-Modal--}} -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content mt">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajout profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br>
      <form method="POST" action="{{ route('admin.profils.store') }}">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="control-label">{{ __('Profil') }}</label>
            <input onblur="notNumber(this)" id="status" type="text" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ old('status') }}" required autocomplete="status" autofocus>

            @error('status')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <input class="btn btn-theme" type="submit" name="Envoyer" id="envoyer" value="Envoyer" />
            <input class="btn btn-danger" type="reset" name="Annuler" id="annuler" value="Annuler" />
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- {{-- End Add Modal--}} -->
<!-- {{-- End Edit Modal--}} -->


<div class="mt">
  @if (Session::has('success'))
  <div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('success') }}
  </div>
  @endif
  <button type="button" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal">
    Ajouter un profil
  </button>

  <div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">
        <table class="table table-striped table-advance table-hover">
          <h4><i class="fa fa-angle-right"></i>Liste des profils</h4>
          <hr>
          <thead>
            <tr>
              <th>#</th>
              <th><i class="fa fa-bookmark"></i> Profil</th>
              <th><i class="fa fa-bookmark"></i> Creation</th>
              <th><i class="fa fa-bookmark"></i> Mise a jour</th>
              <!-- <th><i class="fa fa-bookmark"></i> Actions</th> -->

            </tr>
          </thead>>
          <tbody>
            @foreach($profils as $profil)
            <tr>
              <td>{{$profil->id}}</td>
              <td>{{$profil->status}}</td>
              <td>{{$profil->created_at}}</td>
              <td>{{$profil->updated_at}}</td>
              <!--  <td>
                <a class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
              </td> -->
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
  </div>
  <!-- /row -->

  @endsection
  @include('layouts.footer')