@extends('layout')

@section('content')

<?php 

$fechaInicio = "";
$fechaFinal = "";
$total_t = 0;
if(isset($_GET['generar']) && $_GET['fechaInicio'] != "" && $_GET['fechaFinal'] != ""){
    $update = DB::update("UPDATE PAGOS SET valorDescuento = '1', updated_at = '".date('Y-m-d H:i:s')."' WHERE created_at BETWEEN '".$_GET['fechaInicio']."' AND '".$_GET['fechaFinal']."' and valorDescuento = 0 ");
    $pagos = DB::select("SELECT * FROM pagos WHERE created_at BETWEEN '".$_GET['fechaInicio']."' AND '".$_GET['fechaFinal']."' ");
    $pagos_imprimir = DB::select("SELECT * FROM pagos WHERE created_at BETWEEN '".$_GET['fechaInicio']."' AND '".$_GET['fechaFinal']."' and valorDescuento = 1");
    
    foreach($pagos_imprimir as $obj){
        $obj->idEntrada = App\Entradas::where('id','=',$obj->idEntrada)->get();
    }
    foreach($pagos as $obj){
        $obj->idEntrada = App\Entradas::where('id','=',$obj->idEntrada)->get();
    }
    
    echo "<script>$( '#imprimir' ).trigger( 'click' );</script>";
    $fechaInicio = $_GET['fechaInicio'];
    $fechaFinal = $_GET['fechaFinal'];
    

}

?>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Imprimir</h4>
        </div>
        <div class="modal-body"  style="overflow-y:scroll; height:200px;">
          <div id="imprimir_recibo" style="background: white;">
            <div style="">
                ----------------------------------------------------<br>
                <strong>{{ $parqueaderos->razon_social }}</strong><br>
                <strong>NIT.</strong> {{ $parqueaderos->nit }}<br>
                <strong>TEL.</strong> {{ $parqueaderos->telefonos }}<br>
                <strong>DIR.</strong> {{ $parqueaderos->direccion1 }}<br>
                -----------------------------------------------------
                <br>CIERRE CAJA<br>
                Desde: <?php echo $fechaInicio; ?><br>
                Hasta: <?php echo $fechaFinal; ?><br>
                <br><br>
            </div>
            <div style="">
            <?php 
            if(isset($_GET['generar'])){ $total_t = 0;  ?>
                @foreach($pagos_imprimir as $pagoimp)
                ________________________________________________<br>
                Recibo:{{ $pagoimp->idEntrada[0]->reciboNumero }} <br>
                Placa: {{ $pagoimp->idEntrada[0]->placa }} <br>
                Hora En: {{ $pagoimp->idEntrada[0]->entradaFecha }} <br>
                Hora Sa: {{ $pagoimp->created_at }} <br>
                Total: {{ number_format($pagoimp->valor) }} <br>
                <?php $total_t = $total_t + $pagoimp->valor; ?>
                @endforeach

            <?php  }
            
            ?>
                <hr>
                <strong>Total Cierre: {{ $total_t }}</strong>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <div class="btn btn-success" data-dismiss="modal" onclick="imprimir();">Imprimir</div>
          <div type="button" class="btn btn-default" data-dismiss="modal">Close</div>
        </div>
      </div>
  
    </div>
  </div>


<a href="#" data-toggle="modal" data-target="#myModal" id="imprimir">Imprimir comprobante</a>


<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Cierre Caja</h4>
            <p>Realiza el cierre de caja indicando la fecha de inicio y la fecha final</p><!--valor descuento va a cambiar a estado -->
            <p class="card-category">
                <form class="row" action="" method="GET">
                    <div class="col-md-6">
                        <label>Fecha Inicio</label>
                        <input type="datetime-local" id="fechaInicio" name="fechaInicio" class="form-control" placeholder="Fecha Inicio">
                    </div>
                    <div class="col-md-6">
                        <label>Fecha Final</label>
                        <input type="datetime-local" id="fechaFinal" name="fechaFinal" class="form-control" placeholder="Fecha Inicio">
                    </div>
                    <input class="btn btn-success form-control" type="submit" value="Generar Cierre" name="generar">
                </div>
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                <tr>
                    <th>Parqueadero</th>
                    <th>Recibo</th>
                    <th>Usuario</th>
                    <th>Tipo Pago</th>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Código Barras</th>
                    <th>Fecha Creación</th>
                    <th>Cerrado</th>
                    <th>Fecha Cerrado</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $obj)
                    <tr>
                        <td>{{ $obj->idParqueadero }}</td>
                        <td>{{ $obj->idEntrada[0]->reciboNumero }}</td>
                        <td>{{ $obj->idUsuario }}</td>
                        <td>{{ $obj->idTipoPago }}</td>
                        <td>{{ $obj->subtotal }}</td>
                        <td>{{ $obj->valor }}</td>
                        <td>{{ $obj->codigoBarras }}</td>
                        <td>{{ $obj->created_at }}</td>
                        <td><?php echo ($obj->valorDescuento==0) ? "NO" : "SI";  ?></td>
                        <td><?php echo ($obj->updated_at==$obj->created_at) ? "" : $obj->updated_at; ?></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
  
  function imprimir(){
    var divToPrint=document.getElementById('imprimir_recibo');

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

    newWin.document.close();

    setTimeout(function(){window.location.href = "pagos"; newWin.close();},10);

    

  }
  </script>

        
@endsection()