@extends('layouts.template')
@include('layouts.nav')

@section('content')

<div class="row mt">
    <div class="col-md-6">
        @if (Session::has('comm'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a class="btn btn-theme" href="{{ route('pdfCommande') }}" ;>imprimer reçu</a>
            {{ Session::get('comm') }}
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
        @if (\Session::has('warning'))
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ Session::get('warning') }}
        </div>
        @endif
        <fieldset class="scheduler-border">
            <form action="{{ route('enregistrerCommande') }}" method="post">
                @csrf
                <legend class="scheduler-border"> Produits commandés</legend>

                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:40%">Produit</th>
                            <th style="width:10%">Prix</th>
                            <th style="width:8%">Quantité</th>
                            <th style="width:22%" class="text-center">Total</th>
                            <th style="width:20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0 ?>

                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        <div class="form-group form-check" type="">
                            <input type="hidden" class="form-check-input" name="produits[]" value="{{$id}}" id="{{$id}}" checked />
                        </div>
                        <?php $total += $details['prix'] * $details['quantity'] ?>

                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <h4 class="nomargin">{{ $details['nom'] }}</h4>
                                </div>
                            </td>
                            <td data-th="Price">{{ $details['prix'] }} fcfa</td>
                            <td data-th="Quantity">
                                <input type="number" value="{{ $details['quantity'] }}" min="1" class="form-control quantity" />
                            </td>
                            <td data-th="Subtotal" class="text-center">{{ $details['prix'] * $details['quantity'] }} f</td>
                            <td class="actions" data-th="">
                                <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}" title="modifier la quantité"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}" title="enlever du panier"><img src="{{ asset('images/img/cart1.png')}}"></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center"><strong>Total {{ $total }}</strong></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Totaux {{ $total }} f</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    @if(session('cart'))
                    <div class="form-group">
                        <input type="hidden" name="totaux" id="totaux" class="form-control" value="{{ $total }}" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="id_reglement"> Mode de payment </label><strong>*</strong>
                            <select class="form-control" name="id_reglement" id="id_reglement">
                                @foreach($typeReglement as $reglement)
                                <option value="{{$reglement->id}}">
                                    {{$reglement->type_reglement}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input class="form-control" type="hidden" name="idClient" id="idClient" />    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="telephone"> Telephone du Client</label>
                            <input class="form-control" type="tel" name="telephone" id="telephone" onblur="telephoneCheck(this)"  required />    
                            <datalist id="trouve">

                            </datalist>
                        </div>
                
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label" for="nom">Nom et Prenom du Client</label>
                            <input class="form-control" type="text" name="nom" id="nom" onblur="notNumber(this)" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="Adresse">Adresse du Client</label>
                            <input class="form-control" type="text" name="adresse" id="adresse" onblur="notNumber(this)" required />
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button class="btn btn-theme" type="submit">Enrtegistrer la commande</button>
                </div>
                @endif
            </form>
        </fieldset>

    </div>

    <div class="col-md-6">
        @foreach($products as $product)
        <div class="col-xs-18 col-sm-4 col-md-4">
            <div class="thumbnail">
                <img src="{{$product->photo}}" width="50%" height="50%">
                <div class="caption">
                    <p> <strong>{{ $product->nom }}</strong></p>
                    <p><strong>Prix: </strong> {{ $product->prix }} FCFA</p>
                    <p><a href="{{ url('add-to-cart/'.$product->id) }}" class="btn btn-theme btn-block text-center" role="button">Commande</a> </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div><!-- End row-->
<br>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#telephone').keyup(function() {
                search = $('#telephone').val()
                base = "http://127.0.0.1:8000/search/" + search;

                $.ajax({
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        "Content-Type": "text/html",
                    },
                    url: base,
                    type: "GET",
                    dataType: "JSON",
            
                    success: function(clients) {
                        console.log(clients);
                            document.getElementById('nom').value = clients.data.nom ;
                            document.getElementById('nom').setAttribute('disabled',true)
                            document.getElementById('adresse').value = clients.data.adresse;
                            document.getElementById('idClient').value = clients.data.id;
                            document.getElementById('adresse').setAttribute('disabled',true)
                            document.getElementById('telephone').setAttribute('disabled',true)
                          
                    },
                });
            });


        });
    </script>
<script type="text/javascript">
    $(".update-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: "{{ url('update-cart')}}",
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Voulez vous supprimer ce produit")) {
            $.ajax({
                url: "{{ url('remove-from-cart') }}",
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
    
</script>
@endsection


@include('layouts.footer')