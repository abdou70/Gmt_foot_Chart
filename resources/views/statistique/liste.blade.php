@extends('layouts.template')
@include('layouts.nav')
@section('content')

<div class="row mt">
	<div class="col-md-4">
		<div class="card card-body">
			<h3>Commandes à régler</h3>
			<hr>
			<h1 style="text-align: center;padding: 10px">{{ $nonre }}</h1>

		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-body">
			<h2>Total-Vente</h2>
			<hr>
			<h1 style="text-align: center;padding: 10px">{{ $vente }}</h1>
		</div>
	</div>

	<div class="col-md-4">
		<div class="card card-body">
			<h2>Caisse</h2>
			<hr>
			<h1 style="text-align: center;padding: 10px">{{ $caisse }}</h1>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="card card-body">
			<h3>Commandes réglés</h3>
			<hr>
			<h1 style="text-align: center;padding: 10px">{{ $compte  }}</h1>

		</div>
	</div>
	<?php $v_direct = 0 ?>
	<div class="col-md-4">
		<div class="card card-body">
			<h3>Ventes directs</h3>
			<hr>
			<?php $v_direct = $vente - $compte ?>
			<h1 style="text-align: center;padding: 10px">{{ $v_direct }}</h1>

		</div>
	</div>
</div>


@endsection

@include('layouts.footer')