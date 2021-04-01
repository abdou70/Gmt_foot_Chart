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
    </style>
</head>

<body>
    <h4> Liste des clients</h4>
    <table style="width:100%">
        <tr>
            <th>#</th>
            <th>NOM</th>
            <th>Adresse</th>
            <th>TELEPHONE</th>
        </tr>
        @foreach($clients as $cl)
        <tr>
            <td>{{$cl->id}}</td>
            <td>{{$cl->nom}}</td>
            <td>{{$cl->adresse}}</td>
            <td>{{$cl->tel}}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>