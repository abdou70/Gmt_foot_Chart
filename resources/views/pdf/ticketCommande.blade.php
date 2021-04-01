<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
        td{
            text-align: center;
        }
        hr {
            border-top: 1px dotted green;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .total {
            float: right;
            margin-right: 20%;
        }
    </style>
</head>

<body>
    <div id="colonne_droite">
        <strong>
            <p style="text-align:center; font-weight:bold; font-size:26px ; color:aqua">
                GMT-FOOD
                <br />
            </p>
        </strong>
    </div>

    <fieldset>
        <div class="row">
            <div class="column">
                
            </div>
            <div class="column">
                <p> Date de la commande : {{ $commande->created_at }}</p>
            </div>
        </div>
    
        <div class="row">
            <div class="column">
                <fieldset>
                    <p> <strong>Infos Clients </strong> </p>
                    <p>Nom et Prenom : {{$client->nom}} </p>

                    <p> Adresse : {{$client->adresse}} </p>

                    <p> téléphone : {{$client->tel}} </p>
                </fieldset>
            </div>
            <div class="column">
                <fieldset>
                    <p> <strong>Produits commandés </strong> </p>
                    <table style="width:100%">
                            <tr>
                                <th >Produit</th>
                                <th >Prix</th>
                                <th >Qté</th>
                                <th  >Total</th>
                            </tr>
                            <?php $total = 0 ?>
                            @foreach($info as $id => $details)
                            <tr>    
                                <?php $total += $details['prix'] * $details['quantity'] ?>
                                <td>{{ $details['nom'] }}</td>
                                <td> {{ $details['prix'] }}</td>
                                <td> {{ $details['quantity'] }}</td>
                                <td>{{ $details['prix'] * $details['quantity'] }} f</td> 
                            </tr>
                            @endforeach
                        </table>
                </fieldset>
            </div>
        </div>
              
        <hr>
        <div class="row">
            <div class="column">
                <p> Vous avez été servi par : {{ Auth::user()->name }}</p>
            </div>

            <div class="column">
                <p> <strong> Montant total : {{$total}} fcfa</strong> </p>
            </div>
            </div>
    </fieldset>
</body>

</html>