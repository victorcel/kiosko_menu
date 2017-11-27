@extends('layout.application')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Puntos</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            {!! Form::open(['route' => 'puntos', 'method' => 'POST']) !!}
                            <div class="form-group">
                                <label for="name">Fecha de Inicio:</label>

                                {!! Form::date('f_inicio', null, ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY','required' ]) !!}
                            </div>
                            <div class="form-group">
                                <label for="description">Fecha Final:</label>
                                {!! Form::date('f_fin', null, ['class' => 'form-control', 'placeholder' => 'MM/DD/YYYY','required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('admin.home') }}" class="btn btn-warning">Regresar</a>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@stop
