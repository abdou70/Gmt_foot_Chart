@extends('layouts.template')
@include('layouts.nav')
@section('content')
<div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">
        <table class="table table-striped table-advance table-hover">
          <h4><i class="fa fa-angle-right"></i> Les types_payements</h4>
          <hr>
          <thead>
          <tr>
                     <th>ID</th>
                     <th>type_payements</th>
                     {{-- <th>Action</th>
                     <th>Action</th> --}}
                 </tr>
                 @foreach($liste_reglement as $reglements)
                 <tr>
                     <td>{{ $reglements->id }}</td>
                     <td>{{ $reglements->type_reglement }}</td>
                     {{-- <td><a class="btn btn-theme"  
                      href="{{ route('editreglement' , ['id' => $reglements->id]) }}" >Editer</a></td>
                    <td><a class="btn btn-danger" href="{{ route('deletereglement' , ['id' => $reglements->id]) }}" onclick="return confirm('Voulez-vous vraiement supprimer?')" >Supprimer</a></td> --}}
                  </tr>
                 @endforeach
              </table>
              {{-- {{ $liste_produit->links() }} --}}
              </div>
      <!-- /content-panel -->
    </div>
    <!-- /col-md-12 -->
  </div>
  <!-- /row -->
@endsection
@include('layouts.footer')