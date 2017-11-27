@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tarjeta</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissable ">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="auth-form-body mt-3">
                            {!! Form::open(['route' => 'tarjeta', 'method' => 'post'] ) !!}
                            <div class="form-group">
                                {!! Form::label('numeroid', 'Numero ID') !!}
                                {!! Form::text('numeroid', null, ['class' => 'form-control bfh-number','required' =>'required','autofocus']) !!}
                            </div>{!! Form::close() !!}
                        </div>
                        {{-- <p>{{ str_replace(['%','_'],'','%2862100043006_') }}</p>
                         <p>@{{ lector }}</p>
                         <input v-model.number="lector"  style="visibility:hidden;" type="number" max="9"
                                v-on:keyup.enter="getLector"/>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
