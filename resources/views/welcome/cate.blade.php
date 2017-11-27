@extends('layout.application')

@section('content')
    <div class="container text-center" style="">
        {{ $category->links() }}
        <div id="products">
            @foreach ($category as $categories)
                <div class="product white-panel" style="height: 496px !important;">
                    <h3>{{ $categories->name }}</h3>
                    <img src="{{ Storage::url($categories->image)}}" class="img-responsive img-shirt">
                    <p>
                        <a href="{{ route('welcome.search.category', $categories->slug) }}" class="btn btn-primary"> <i class="fa fa-chevron-circle-right"></i>Ingresar</a>
                    </p>
                </div>

            @endforeach
        </div>

    </div>
@stop

