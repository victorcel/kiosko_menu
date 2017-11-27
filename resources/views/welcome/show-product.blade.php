@extends('layout.application')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"></i> Detalle del producto </h1>
		</div>
		<div class="row no-margin">
			<div class="col-md-6">
				<div class="product-block">
					<img src="{{ Storage::url($product->image)}}" class="img-responsive">
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-block panel large-padding" style="padding: 10px 15px;">
					<h3>{{ $product->name }}</h3>
					<div class="product-info">
						<p>{{ $product->description }}</p>
						<h3>
							<span class="label label-success">Puntos: ${{ $product->points }}</span>
						</h3>
						@if( $product->visible ==1)
							<a href="#" class="btn btn-warning" data-toggle="modal" @click="getSlug('{{$product->slug}}')"
							   data-target="#create"> <i class="fa fa-cart-plus disabled"></i> Lo quiero</a>
						@endif
						<a href="{{ route('welcome.index') }}" class="btn btn-primary">
							<i class="fa fa-chevron-circle-left"></i> Regresar
						</a>
					</div>
					@include('welcome.confir')
				</div>
			</div>
		</div><hr>
		<p>

		</p>
	</div>
@stop
