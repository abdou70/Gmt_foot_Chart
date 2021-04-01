
@extends('layouts.template')
@include('layouts.nav')

@section('content')

<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Liste des ventes d'aujourd'hui</h4>
                <hr>
                <thead>
                    <tr>
                        <th>date Commande</th>
                        <th>Type Reglement</th>
                        <th>Cout total</th>
                    </tr>
                    @foreach($commandes as $com)
                    <tr>
                        <td>{{ $com->created_at }}</td>
                        <td>{{\App\Reglement::find($com->reglement_id)->type_reglement }}</td>
                        <td>{{ $com->montant }}f</td>
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