@extends('layout.application')

@section('content')
    <div class="container text-center" style="">
        <div>
            <p>{{ $products->links() }} </p>
            <p><a href="{{ route('welcome.cate') }}" class="btn btn-default"> Categorias</a></p>
        </div>

        <div id="products">
            @foreach ($products as $product)
                <div class="product white-panel" style="height: 496px !important;">
                    <h3>{{ $product->name }}</h3>
                    <img src="{{ Storage::url($product->image)}}" class="img-responsive img-shirt">
                    <div class="product-info">
                        <p>{{ $product->extract }}</p>
                        <h3><span class="label label-success">Puntos: ${{ $product->points }}</span></h3>
                        <p>
                            @if( $product->visible ==1)
                                {{--<a href="{{ route('cart.add', $product->slug) }}" class="btn btn-warning"><i class="fa fa-cart-plus disabled"></i>PARA LLEVAR</a>
                                <a href="{{ route('cart.add', $product->slug) }}" class="btn btn-primary" data-toggle="modal" data-target="#create"><i class="fa fa-cart-plus disabled" ></i>PARA CONSUMIR AQUÍ </a>--}}
                                <a href="#" class="btn btn-warning" data-toggle="modal" @click="getSlug('{{$product->slug}}')"
                                   data-target="#create"> <i class="fa fa-cart-plus disabled"></i> Lo quiero</a>
                            @endif

                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary"> <i
                                        class="fa fa-chevron-circle-right"></i> Leer mas</a>
                        </p>

                    </div>

                </div>
            @endforeach
        </div>
        @include('welcome.confir')
    </div>
@stop
