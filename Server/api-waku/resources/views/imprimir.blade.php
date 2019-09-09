<style type="text/css">
	*{
		font-size: 10px;
		padding: 0 auto;
		margin: 0 auto;
	}
</style>

<?php

$fechaEntrada = $pagos[0]->idEntrada[0]->entradaFecha;
$fechaSalida = $pagos[0]->idEntrada[0]->salidaFecha;
$fechaEntrada = explode('-',$fechaEntrada);
$fechaSalida = explode('-',$fechaSalida);
$fechaEn = $fechaEntrada[0] . "/" . $fechaEntrada[1] . "/" . explode(" ",$fechaEntrada[2])[0] . " Hora " + explode(" ",$fechaEntrada[2])[1];
$fechaSa = $fechaSalida[0] . "-" . $fechaSalida[1] . "-" . explode(" ",$fechaSalida[2])[0] . " Hora " + explode(" ",$fechaSalida[2])[1];

echo $fechaEn;
?>

<a href="/entradas"><div style="background: rgba(73,155,234,1);border-radius: 0px 0px 57px 57px;
	-moz-border-radius: 0px 0px 57px 57px;
	-webkit-border-radius: 0px 0px 57px 57px;
	border: 0px solid #000000;width: 100px;text-aling:center;position:absolute;color:white;z-index:1000;"><center><strong>Regresar</strong></center></div></a>
  
  
<div id="imprimir_recibo">

<div style="">
	----------------------------------------------------<br>
	<strong>{{ $parqueaderos->razon_social }}</strong><br>
	<strong>NIT.</strong> {{ $parqueaderos->nit }}<br>
	<strong>TEL.</strong> {{ $parqueaderos->telefonos }}<br>
	<strong>DIR.</strong> {{ $parqueaderos->direccion1 }}<br>
	-----------------------------------------------------
	<br><br>
</div>
<strong>{{ $pagos[0]->idEntrada[0]->created_at }}</strong><br><br>
<strong>Recibo: </strong>{{ $pagos[0]->idEntrada[0]->reciboNumero }}<br>
<strong>Placa: </strong>{{ $pagos[0]->idEntrada[0]->placa }}<br><br>


<strong>Servicio: </strong><br>{{ $pagos[0]->idEntrada[0]->idTarifa[0]->nombreTarifa}}<br>
<strong>Hora Entrada: </strong><br>{{ $pagos[0]->idEntrada[0]->entradaFecha }}<br>
<strong>Hora Salida: </strong><br>{{ $pagos[0]->idEntrada[0]->salidaFecha }}
<br><br>
<strong>Total</strong><br><?php echo number_format($pagos[0]->valor); ?><br><br>

-----------------------------------------------<br>
Parkapp <br>
Desarrollado por Interconsis - Wakusoft <br>
NIT. 1030570356 <br>
-----------------------------------------------

</div>


<script>


		imprimir();
				function imprimir(){
				  var divToPrint=document.getElementById('imprimir_recibo');
			  
				  var newWin=window.open('','Print-Window');
			  
				  newWin.document.open();
			  
				  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
			  
				  newWin.document.close();
			  
				  setTimeout(function(){window.location.href ="entradas";newWin.close();},10);
				}
				</script>