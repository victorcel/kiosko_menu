@extends('layout.application')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"></i> Detalle del pedido </h1>
		</div>
		<div class="page table-cart">
			<div class="table-responsive">
				<h3>Datos del usuario</h3>
				<table class="table table-striped table-hover table-bordered">
					<tr><td>Nombre: </td><td>{{ Auth::user()->name }}</td></tr>
					<tr><td>Apellido: </td><td>{{ Auth::user()->last_name }}</td></tr>
					<tr><td>Tarjeta: </td><td>{{ substr(Auth::user()->email,5,9)}}</td></tr>
					{{--<tr><td>Dirección: </td><td>{{ Auth::user()->address }}</td></tr>--}}
				</table>
			</div>
			<div class="table-responsive text-center">
				<h3>Datos del pedido</h3>
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th class="text-center">Producto</th>
						<th class="text-center">Puntos</th>
						<th class="text-center">Cantidad</th>
						<th class="text-center">Subtotal</th>
					</tr>
					@foreach ($cart as $item)
						<tr>
							<td>{{ $item->name }}</td>
							<td>{{ $item->points }}</td>
							<td>{{ $item->quantity }}</td>
							<td>{{ $item->points * $item->quantity }}</td>
						</tr>
					@endforeach
				</table><hr>
				<h3>
					<span class="label label-success">
						Total: ${{ $total}}
					</span>
				</h3>
				<hr>
				<p>
					<a href="{{ route('cart.show') }}" class="btn btn-primary">
						<i class="fa fa-chevron-circle-left"></i> Regresar
					</a>
					<a href="{{ route('payment') }}" class="btn btn-warning">c
						Pagar con <i class="glyphicon glyphicon-tags"></i>
					</a>
				</p>
			</div>
		</div>
	</div>
@stop
