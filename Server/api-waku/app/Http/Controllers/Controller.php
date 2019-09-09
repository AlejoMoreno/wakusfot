<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Parqueaderos;
use App\TipoPagos;
use App\TipoVehiculos;
use App\TipoUsuarios;
use App\Tarifas;
use App\Entradas;
use App\Pagos;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function calcularTarifa(Request $request){
        if($request->fechaLLegada && $request->servicio){

            $fechaLLegada = date($request->fechaLLegada);
            $fechaSalida = date("d-m-Y H:i:s");


            //control cantidad de tiempo
            $ListFechaLLegada = explode('-',$fechaLLegada);
            $ListFechaSalida = explode('-',$fechaSalida);
            
            $dia = $ListFechaSalida[0] - $ListFechaLLegada[0];
            $mes = $ListFechaSalida[1] - $ListFechaLLegada[1];
            $ano = explode(" ",$ListFechaSalida[2])[0] - explode(" ",$ListFechaLLegada[2])[0];
            $hora = explode(":",explode(" ",$ListFechaSalida[2])[1])[0] - explode(":",explode(" ",$ListFechaLLegada[2])[1])[0];
            $min = explode(":",explode(" ",$ListFechaSalida[2])[1])[1] - explode(":",explode(" ",$ListFechaLLegada[2])[1])[1];

            if($min < 0){
                $min = $min + 60;
                $hora = $hora - 1;
            }
            if($hora < 0){
                $hora = $hora + 24;
                $dia = $dia - 1;
            }
            if($dia < 0){
                $dia = $dia + 31;
            }


            //control calculo de tarifa
            $tarifas = Tarifas::where('id','=',$request->servicio)->get()[0];
            $total = 0;

            $min_1 = $min;
            $hora_1 = $hora;
            $dia_1 = $dia;
            $mes_1 = $mes;
            
            if($mes_1>=1 ){
                $total = $total + ($tarifas->mensualidad * $mes);
                if($dia_1>=30 ){
                    $total = $total + $tarifas->mensualidad;
                }
                if($dia_1<30 ){
                    $total = $total + ($tarifas->quincena * ($dia * 2));
                    if($hora_1>=12 ){
                        $total = $total + $tarifas->quincena;
                        $h = $hora_1 - 12;
                        if($h>0){
                            $total = $total + ($tarifas->valorHora * $h);
                        }
                        if($min_1<=45 ){
                            $total = $total + $tarifas->valorMinuto;
                        }
                        if($min_1>45 ){
                            $total = $total + $tarifas->valorHora;
                        }
                    }
                    if($hora_1<12){
                        $total = $total + ($tarifas->valorHora * $hora);
                        if($min_1<=45 && $dia_1==0 ){
                            $total = $total + $tarifas->valorMinuto;
                        }
                        if($min_1>45 && $dia_1==0 ){
                            $total = $total + $tarifas->valorHora;
                        }
                    }
                }
            }
            if($dia_1>=30 && $mes_1==0){
                $total = $total + $tarifas->mensualidad;
            }
            if($dia_1<30 && $mes_1==0 && $dia_1!=0){
                $total = $total + ($tarifas->quincena * ($dia * 2));
                if($hora_1>=12 && $mes_1==0){
                    $total = $total + $tarifas->quincena;
                    $h = $hora_1 - 12;
                    if($h>0){
                        $total = $total + ($tarifas->valorHora * $h);
                    }
                    if($min_1<=45 && $mes_1==0){
                        $total = $total + $tarifas->valorMinuto;
                    }
                    if($min_1>45 && $mes_1==0){
                        $total = $total + $tarifas->valorHora;
                    }
                }
                if($hora_1<12 && $mes_1==0 ){
                    $total = $total + ($tarifas->valorHora * $hora);
                    if($min_1<=45  && $mes_1==0){
                        $total = $total + $tarifas->valorMinuto;
                    }
                    if($min_1>45 && $mes_1==0){
                        $total = $total + $tarifas->valorHora;
                    }
                }
            }
            if($hora_1>=12 && $dia_1==0 && $mes_1==0){
                $total = $total + $tarifas->quincena;
                $h = $hora_1 - 12;
                if($h>0){
                    $total = $total + ($tarifas->valorHora * $h);
                }
                if($min_1<=45 && $mes_1==0){
                    $total = $total + $tarifas->valorMinuto;
                }
                if($min_1>45 && $mes_1==0){
                    $total = $total + $tarifas->valorHora;
                }
            }
            if($hora_1<12 && $dia_1==0 && $mes_1==0 && $hora_1!=0){
                $total = $total + ($tarifas->valorHora * $hora);
                if($min_1<=45 && $dia_1==0 && $mes_1==0){
                    $total = $total + $tarifas->valorMinuto;
                }
                if($min_1>45 && $dia_1==0 && $mes_1==0){
                    $total = $total + $tarifas->valorHora;
                }
            }
            if($min_1>45 && $hora_1==0 && $dia_1==0 && $mes_1==0){
                $total = $total + $tarifas->valorHora;
            }
            if($min_1<=45 && $hora_1==0 && $dia_1==0 && $mes_1==0){
                $total = $total + $tarifas->valorMinuto;
            }

            return array([
                "result"=>"true",
                "body"=>array([
                    "mes"=>$mes,
                    "dia"=>$dia,
                    "hora"=>$hora,
                    "min"=>$min,
                    "pago"=>$total
                ])
            ]);
        }
        else{
            return array([
                "result"=>"false",
                "body"=>array([
                    "mes"=>0,
                    "dia"=>0,
                    "hora"=>0,
                    "min"=>0,
                    "pago"=>0
                ])
            ]);
        }
    }


}
