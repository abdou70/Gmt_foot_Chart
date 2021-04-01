@extends('layouts.template')
@include('layouts.nav')

@section('content')

<div class="row mt">
    <div class="col-md-12 P-1">
        <a type="button" class="btn btn-theme" href="{{ route('nonlivres') }}">
            Commandes non Livré
        </a>
    </div>
</div>
<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Liste des commandes d'aujourd'hui</h4>
                <hr>
                <thead>
                    <tr>
                        <th>date Commande</th>
                        <th>Nom Client</th>
                        <th>Numero client</th>
                        <th>Type Reglement</th>
                        <th>Cout total</th>
                        <th>Etat</th>
                        <th>Action</th>

                    </tr>
                    @foreach($commandes as $com)
                    <tr>
                        <td>{{ $com->created_at }}</td>  
                        <td>{{\App\Client::find($com->client_id)->nom }}</td>
                        <td>{{\App\Client::find($com->client_id)->tel }}</td>
                        <td>{{\App\Reglement::find($com->reglement_id)->type_reglement }}</td>
                        <td>{{ $com->montant }} f</td>
                        @if($com->etat_commande == 0)
                        <td><p class="btn btn-danger">à livré</p></td>
                        @else
                        <td ><p class="btn btn-success">livré</p></td>
                        @endif
                        @if($com->etat_commande == 0)
                        <td><a class="btn btn-theme"href="{{ route('validerlivraison' , ['id' => $com->id]) }}" onclick="return confirm('Est ce que la commande est livrée?')";>Valider livraison</a></td>
                        @endif
                    </tr>
                    @endforeach
            </table>
             {{ $commandes->links() }} 
        </div>
        <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
</div>
<!-- /row -->
@endsection


@include('layouts.footer')