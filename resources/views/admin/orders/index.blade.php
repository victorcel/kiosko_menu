@extends('admin.template')

@section('content')
    <div class="container text-center">
        <div class="page-header">
            <h1>
                <i class="fa fa-shopping-cart"></i> PEDIDOS
            </h1>
        </div>

        <div class="page">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Ver Detalle</th>
                            <th>Eliminar</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <a
                                        href="#"
                                        class="btn btn-primary btn-detalle-pedido"
                                        data-id="{{ $order->id }}"
                                        data-path="{{ route('admin.orders.getItems') }}"
                                        data-toggle="modal"
                                        data-target="#myModal"
                                        data-token="{{ csrf_token() }}"
                                    >
                                        <i class="fa fa-external-link"></i>
                                    </a>
                                </td>
                                <td>
                                  <a href="{{ route('admin.orders.destroy', $order->id) }}" class="btn btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                  </a>
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->user->name . " " . $order->user->last_name }}</td>
                                <td>${{$order->subtotal }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>

            <?php echo $orders->render(); ?>

        </div>
    </div>
    @include('admin.partials.modal-detalle-pedido')
@stop
