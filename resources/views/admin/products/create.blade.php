@extends('admin.template')
@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1>
                <i class="fa fa-shopping-cart"></i>
                PRODUCTOS
                <small>[Agregar producto]</small>
            </h1>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="page">
                    @include('admin.partials.errors')
                    {!! Form::open(['route' => 'products', 'method' => 'POST', 'files' => 'true']) !!}
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el nombre...']) !!}
                    </div>
                    <div class="form-group">
                        <label for="points">Puntos:</label>
                        {!! Form::number('points', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el precio...','min'=>'1']) !!}
                    </div>
                    <div class="form-group">
                        <label for="description">Descripcion:</label>
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="extract">Pequeña Desc:</label>
                        {!! Form::text('extract', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Categoría: </label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                        </select>
                        {{--{!! Form::select('category_id', $categories->pluck('name'),$categories->pluck("id"), ['class' => 'form-control']) !!}--}}
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen:</label>
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="visible">Estado del Producto</label>
                        <select class="form-control" name="visible">

                            <option value="1"> Activo</option>
                            <option value="0"> Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('products.index') }}" class="btn btn-warning">Regresar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop