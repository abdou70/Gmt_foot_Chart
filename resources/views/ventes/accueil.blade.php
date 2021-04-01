@extends('layouts.template')
@include('layouts.nav')

@section('content')

<div class="row mt">
    <div class="col-md-6">
        @if (Session::has('vente'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <a class="btn btn-theme" href="{{ route('pdfvente') }}";>imprimer reçu</a>
            {{ Session::get('vente') }}
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
            <form action="{{ route('enregistrerVente') }}" method="post">
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

                        @if(session('cartv'))
                        @foreach(session('cartv') as $id => $details)
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
                                <button class="btn btn-info btn-sm update-cartv" data-id="{{ $id }}" title="modifier la quantité"><i class="fa fa-refresh"></i></button>
                                <button class="btn btn-danger btn-sm remove-from-cartv" data-id="{{ $id }}" title="enlever du panier"><img src="{{ asset('images/img/cart1.png')}}"></button>
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

                @if(session('cartv'))
                <div class="form-group">
                    <input type="hidden" name="totaux" id="totaux" class="form-control" value="{{ $total }}" />
                </div>
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
                <button class="btn btn-theme" type="submit" > Enrtegistrer la vente</button>
                  
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
                    <p><a href="{{ url('add-to-cartv/'.$product->id) }}" class="btn btn-theme btn-block text-center" role="button">Commande</a> </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div><!-- End row-->
<br>

<script type="text/javascript">
    $(".update-cartv").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: "{{ url('update-cartv')}}",
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

    $(".remove-from-cartv").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Voulez vous supprimer ce produit")) {
            $.ajax({
                url: "{{ url('remove-from-cartv') }}",
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