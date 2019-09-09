<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Parqueaderos;
use App\TipoPagos;
use App\TipoVehiculos;
use App\TipoUsuarios;
use App\Tarifas;
use App\Entradas;
use App\Pagos;

class ParqueaderosController extends Controller
{
    /**
     * 'razon_social',
        'direccion1',
        'direccion2',
        'propietario',
        'telefonos',
        'nit',
        'rango_factura',
        'regimen',
        'porcentajeIva',
        'limiteVehiculos',
        'limieteMotos'
     */
    public function createParqueaderos(Request $request){
        $obj = Parqueaderos::where('id','=',$request->id)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjParqueaderos($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new Parqueaderos();
            ParqueaderosController::ObjParqueaderos($obj,$request);
            $obj->save();
        }
        return redirect('configuracion');
    }
    public function createTipoPago(Request $request){
        $obj = TipoPagos::where('nombre','=',$request->nombre)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjTipoPagos($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new TipoPagos();
            ParqueaderosController::ObjTipoPagos($obj,$request);
            $obj->save();
        }
        return redirect('configuracion');
    }
    public function tipoVehiculo(Request $request){
        $obj = TipoVehiculos::where('nombre','=',$request->nombre)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjTipoVehiculos($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new TipoVehiculos();
            ParqueaderosController::ObjTipoVehiculos($obj,$request);
            $obj->save();
        }
        return redirect('configuracion');
    }
    public function createtipoUsuarios(Request $request){
        $obj = TipoUsuarios::where('nombre','=',$request->nombre)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjTipoUsuarios($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new TipoUsuarios();
            ParqueaderosController::ObjTipoUsuarios($obj,$request);
            $obj->save();
        }
        return redirect('configuracion');
    }
    public function createTarifas(Request $request){
        $obj = Tarifas::where('nombreTarifa','=',$request->nombreTarifa)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjTarifas($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new Tarifas();
            ParqueaderosController::ObjTarifas($obj,$request);
            $obj->save();
        }
        return redirect('servicios');
    }
    public function createPagos(Request $request){
        $obj = Pagos::where('id','=',$request->id)->first();
        if(sizeof($obj) != 0 ){ //actualizar
            ParqueaderosController::ObjPagos($obj,$request);
            $obj->save();
        }
        else { //crear
            $obj = new Pagos();
            ParqueaderosController::ObjPagos($obj,$request);
            $obj->save();
        }
        return redirect('servicios');
    }
    public function createEntradas(Request $request){
        if($request->registrar == "registrar"){
            $obj = Entradas::where('placa','=',$request->placa)->where("salidaFecha","=",NULL)->first();
            if(sizeof($obj) != 0 ){ //actualizar
                ParqueaderosController::ObjEntradas($obj,$request);
                
                $obj->save();
            }
            else { //crear
                $obj = new Entradas();
                $obj_1 = Entradas::where('id','>',0)->orderBy('reciboNumero','DESC')->get();
                if(sizeof($obj_1) != 0 ){
                    $request->reciboNumero = ($obj_1[0]->reciboNumero + 1);
                }
                else{
                    $request->reciboNumero = "0";
                }
                ParqueaderosController::ObjEntradas($obj,$request);
                $obj->entradaFecha = date("d-m-Y H:i:s");
                $obj->salidaFecha = null;
                $obj->save();
            }
            $parqueaderos = Parqueaderos::where('id','>','0')->first();
            return array([
                "result"=>"true",
                "body"=>$obj,
                "parqueaderos"=>$parqueaderos
            ]);
        }
        else if($request->pagar == "pagar"){ //aca es el cambio 
            $obj = new Pagos();
            if($request->plena != ""){
//fghgjkgjk
            }
            else if($request->mensualidad != ""){
//vhjkfgjh
            }
            else{ // normal
                ParqueaderosController::ObjPagos($obj,$request);
                $obj->save();
            }
            
            $obj_1 = Entradas::where('placa','=',$request->placa)->where("salidaFecha","=",NULL)->first();
            //ParqueaderosController::ObjEntradas($obj_1,$request);
            $obj_1->salidaFecha = date("d-m-Y H:i:s");
            $obj_1->save();
            return redirect("imprimir/".$obj->id);
        }
        
    }
    static function ObjParqueaderos(Parqueaderos $obj, Request $request){
        $obj->razon_social  = $request->razon_social;
        $obj->direccion1    = $request->direccion1;
        $obj->direccion2    = ($request->direccion2 == "") ? "NA" : $request->direccion2;
        $obj->propietario   = $request->propietario;
        $obj->telefonos     = $request->telefonos;
        $obj->nit           = $request->nit;
        $obj->rango_factura = $request->rango_factura;
        $obj->regimen       = $request->regimen;
        $obj->porcentajeIva = $request->porcentajeIva;
        $obj->limiteVehiculos = $request->limiteVehiculos;
        $obj->limieteMotos  = $request->limieteMotos;
        return $obj;
    }
    static function ObjTipoPagos(TipoPagos $obj, Request $request){
        $obj->nombre    = $request->nombre;
        return $obj;
    }
    static function ObjTipoVehiculos(TipoVehiculos $obj, Request $request){
        $obj->nombre            = $request->nombre;
        $obj->tarifaSugerida    = $request->tarifaSugerida;
        $obj->urlLogo           = $request->urlLogo;
        return $obj;
    }
    static function ObjTipoUsuarios(TipoUsuarios $obj, Request $request){
        $obj->nombre    = $request->nombre;
        return $obj;
    }
    static function ObjTarifas(Tarifas $obj, Request $request){
        $obj->idParqueadero     = $request->idParqueadero;
        $obj->idTipoVehiculo    = $request->idTipoVehiculo;
        $obj->nombreTarifa      = $request->nombreTarifa;
        $obj->valorHora         = $request->valorHora;
        $obj->valorMinuto       = $request->valorMinuto;
        $obj->quincena          = $request->quincena;
        $obj->mensualidad       = $request->mensualidad;
        $obj->vigendeDesde      = $request->vigendeDesde;
        $obj->vigenteHasta      = $request->vigenteHasta;
        $obj->estado            = $request->estado;
        return $obj;
    }

    static function ObjEntradas(Entradas $obj, Request $request){
        $obj->idParqueadero = $request->idParqueadero;
        $obj->idCliente     = $request->idCliente;
        $obj->idTarifa      = $request->idTarifa;
        $obj->idUsuario     = $request->idUsuario;
        $obj->placa         = $request->placa;
        $obj->descripcion   = $request->descripcion;
        $obj->nota          = $request->nota;
        $obj->entradaFecha  = $request->entradaFecha;
        $obj->entradaHora   = "0";
        $obj->reciboPrefijo = $request->reciboPrefijo;
        $obj->reciboNumero  = $request->reciboNumero;
        $obj->salidaFecha   = ($request->salidaFecha == $request->entradaFecha) ? NULL : $request->salidaFecha;
        $obj->salidaHora    = "0";
        $obj->codigoBarras  = $request->codigoBarras;
        return $obj;
    }

    static function ObjPagos(Pagos $obj, Request $request){
        $obj->idParqueadero = $request->idParqueadero;
        $obj->idEntrada     = $request->idEntrada;
        $obj->idUsuario     = $request->idUsuario;
        $obj->idTipoPago    = $request->idTipoPago;
        $obj->subtotal      = $request->subtotal;
        $obj->valor         = $request->valor;
        $obj->valorDescuento = $request->valorDescuento;
        $obj->iva           = $request->iva;
        $obj->retencion     = $request->retencion;
        $obj->codigoBarras  = $request->codigoBarras;
        return $obj;
    }
}