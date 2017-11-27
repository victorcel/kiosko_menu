@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-3 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Numero de Tarjeta: <strong> {{ $consulta }} </strong></h3></div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success ">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="auth-form-body mt-3">
                            {!! Form::open(['route' => ['login'] , 'method' => 'post'] ) !!}
                            <div class="form-group">
                                {!! Form::text('email', null, ['class' => 'form-control bfh-number','required' =>'required','autofocus','v-model="getCedula"','placeholder'=>"Digite su Cedula"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('password',"$consulta") !!}
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-md-offset-3">
                                    <table class="">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('1')">
                                                    1
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('2')">
                                                    2
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('3')">
                                                    3
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('4')">
                                                    4
                                                </button>
                                            </td>

                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('5')">
                                                    5
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('6')">
                                                    6
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('7')">
                                                    7
                                                </button>
                                            </td>

                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('8')">
                                                    8
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('9')">
                                                    9
                                                </button>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-default btn-lg"
                                                        @click.prevent="mensaje.push('0')">
                                                    0
                                                </button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>

                                            </td>
                                            <td colspan="2">

                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>


                                </div>

                            </div>

                            {!! Form::submit('OK', ['class' => 'btn btn-success btn-lg pull-left']) !!}
                            {!! Form::close() !!}
                            {!! Form::submit('BORRAR', ['class' => 'btn btn-danger btn-lg pull-right','@click="borrarTarjeta"']) !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection