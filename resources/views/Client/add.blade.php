@extends('layouts.template')
@include('layouts.nav')

@section('content')
<!-- {{-- Start-Add-Modal--}} -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Clients</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/client/persist">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label" for="nom">Nom et Prenom du Client</label>
                        <input class="form-control" type="text" name="nom" id="nom" onblur="notNumber(this)" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="Adresse">Adresse du Client</label>
                        <input class="form-control" type="text" name="adresse" id="adresse" onblur="notNumber(this)" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="telephone"> Telephone du Client</label>
                        <input class="form-control" type="text" name="telephone" id="telephone " onblur="telephoneCheck(this)" required />
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

<div class="mt">
    @if(count($errors) > 0)

    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $error }}
            </div>
            @endforeach
        </ul>
    </div>
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('success') }}
        </div>
    @endif
    <button type="button" class="btn btn-theme" data-toggle="modal" data-target="#exampleModal" disabled>
        Ajout des Clients
    </button>
    <a class="btn btn-theme" href="{{ route('exportclients')}}">
        Exporter la liste
    </a>
    <input class="search" id="search" placeholder=search... type="search" name="search" class="form-control" autocomplete="off">
    <datalist id="trouve"></datalist>

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Liste des Clients</h4>
                    <hr>

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Télephone</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>


                    <tbody id="datatable1">
                        {{csrf_field() }}
                        @foreach($clients as $cl)
                        <tr>
                            <th>{{$cl->id}}</th>
                            <td>{{$cl->nom}}</td>
                            <td>{{$cl->adresse}}</td>
                            <td>{{$cl->tel}}</td>
                            <!--    @if($cl->fidele == 0)
                            <td>Non</td>
                            @else
                            <td>Oui</td>
                            @endif -->
                            <td>
                                <a href="{{ route('editclient', ['id' => $cl->id]) }}" class="btn btn-theme edit">Editer</a>

                                <a href="{{route('delete', ['id' => $cl->id])}}" onclick="return confirm('voulez-vous supprimer le client?')" ; class="btn btn-danger delete">DELETE</a>
                            </td>


                            @endforeach
                    </tbody>
                    <tbody id="datatable2">

                    </tbody>

                </table>
                {{ $clients->links() }}
            </div>
            <!-- /content-panel -->
        </div>
        <!-- /col-md-12 -->
    </div>
    <!-- /row -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable2').hide()
            $('#search').keyup(function() {
                // $('#datatable1').Datatable()
                search = $('#search').val()
                base = "http://127.0.0.1:8000/client/searchNom/" + search;

                $.ajax({
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        "Content-Type": "text/html",
                    },
                    url: base,
                    type: "GET",
                    dataType: "JSON",
                    success: function(clients) {
                        /** var tables = '';
                            $.each(data,function (key, value) {
                                tables+='<tr>';
                                tables+='<td>'+value.description_erreur+ '</td>';
                                tables+='<td>'+value.description_traitement+ '</td>';
                                tables+='</tr>';
                            })

                            $('#tbody').empty().html(tables); */
                        //console.log(data)
                        //alert(data)
                        //console.log( )
                        $('#datatable2').show()
                        var tables = '';
                        $.each(clients.data, function(key, value) {
                            tables += '<tr>';
                            tables += '<td>' + value.id + '</td>';
                            tables += '<td>' + value.nom + '</td>';
                            tables += '<td>' + value.adresse + '</td>';
                            tables += '<td>' + value.tel + '</td>'
                            tables += '<td> <a href="" class="btn btn-success">EDIT</a> <a href="" class="btn btn-danger">DELETE</a></td>';

                            tables += '</tr>';
                        })
                        $('#datatable2').empty().html(tables);
                        $('#datatable1').hide()

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#datatable1').show()
                        $('#datatable2').hide()
                    }
                });
            });


        });
    </script>
    @endsection
    @include('layouts.footer')