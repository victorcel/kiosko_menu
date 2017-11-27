<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4>TIPO DE PEDIDO </h4>
            </div>
            <div class="modal-body">
                <h1><p>Si la <b>cortesía es para llevar</b>, la equivalencia en puntos de este producto aumenta 10 veces.</p></h1>
                {{--<pre>@{{ slug }}</pre>--}}
                <a :href="getDirConfir" class="btn btn-warning"><i class="fa fa-cart-plus disabled"></i>PARA LLEVAR</a>
                <a :href="getDirAdd" class="btn btn-primary" :click="descrementCounter"><i class="fa fa-cart-plus disabled"></i>PARA CONSUMIR AQUÍ </a>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>