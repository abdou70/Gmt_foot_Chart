@extends('layouts.template')
@include('layouts.nav')
@section('content')
<!-- {{-- Start-Add-Modal--}} -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content mt">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajout utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom et Prenom') }}</label>

                        <div class="col-md-6">
                            <input id="name" onblur="notNumber(this)" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nom Utilisateur') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" onblur="notNumber(this)" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>


                    <div class="form-group row ">
                        <div class="col-md-4"></div>
                        <div class="col-md-8 ">
                            <button class="btn btn-theme" type="submit"> {{ __('Enregistrer') }}</button>
                            <button class="btn btn-theme04" type="reset">{{ __('Annuler') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- {{-- End Add Modal--}} -->
<!-- {{-- End Edit Modal--}} -->


<div class="mt">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('error') }}
    </div>
    @endif
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}
    </div>
    @endif
    <button type="button" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal">
        Ajouter un utilisateur
    </button>

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Liste des utilisateurs</h4>
                    <hr>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Nom Utilisateur</th>
                            <th>Profils</th>
                            <th>Mise à jour </th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{implode(', ',$user->profils()->get()->pluck('status')->toArray())}}</td>
                            <td>{{$user->updated_at}}</td>
                            @can('manage-users')

                            <td><a href="{{ route('admin.users.edit', $user->id) }}" title="modifier user" class="btn btn-theme btn-sm shadow-lg  mb-2  rounded">affecter roles</a></td>
                            <td><a class="btn btn-primary" href="{{ route('admin.set-pass',$user->id) }}" onclick="return confirm('l\'utilisateur? a t-il oublié son mot de passe' )" ;>changer mot de passe</a></td>
                            <td><a class="btn btn-danger" href="{{ route('admin.deleteuser' , ['id' => $user->id]) }}" onclick="return confirm('Voulez-vous supprimer l\'utilisateur?')" ;>Supprimer</a></td>
                           
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-md-12 -->
    </div>
    <!-- /row -->

    @endsection

    @include('layouts.footer')