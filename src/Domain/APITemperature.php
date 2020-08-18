<?php

namespace PH\Domain;

use HttpRequest;

final class APITemperature
{
    private $url;
    private $initial_date;
    private $end_date;

    public function __construct()
    {
        $this->url = "";
        $this->initial_date = "";
        $this->end_date = "";
    }

    public function getUrl(){
        return $this->url;
    }

    public function getInitial_Date(){
        return $this->initial_date . "T00:00:00UTC";
    }

    public function setInitial_Date($initial_date){
        $this->initial_date =$initial_date;
    }

    public function setEnd_Date($end_date){
        $this->end_date = $end_date;
    }


    public function getEnd_Date(){
        return $this->end_date . "T00:00:00UTC";
    }

    public function readData($initial_date, $end_date){
        $this->setInitial_Date($initial_date);
        $this->setEnd_Date($end_date);

        $ini = $this->getInitial_Date();
        $end = $this->getEnd_Date();

        //$url_aux = "https://opendata.aemet.es/opendata/api/valores/climatologicos/diarios/datos/fechaini/" . $ini . "/fechafin/" . $end . "/todasestaciones";
        $url_aux = "https://opendata.aemet.es/opendata/api/valores/climatologicos/inventarioestaciones/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJmcmFuY2lzY29yaWNvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiIxZmRmNGViMS02ZDc4LTQ0NTYtYjY3ZC0yZGJkY2FkNGQzZTEiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTU5NzM5ODc2OCwidXNlcklkIjoiMWZkZjRlYjEtNmQ3OC00NDU2LWI2N2QtMmRiZGNhZDRkM2UxIiwicm9sZSI6IiJ9.eq_Tpe5_lC0httXz9tU-7kT9wT7a7XkWDEj0jvGSF3I";
        // EJEMPLO DE CODIGO CLIENTE DE AEMET

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://opendata.aemet.es/opendata/api/valores/climatologicos/inventarioestaciones/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJmcmFuY2lzY29yaWNvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiIxZmRmNGViMS02ZDc4LTQ0NTYtYjY3ZC0yZGJkY2FkNGQzZTEiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTU5NzM5ODc2OCwidXNlcklkIjoiMWZkZjRlYjEtNmQ3OC00NDU2LWI2N2QtMmRiZGNhZDRkM2UxIiwicm9sZSI6IiJ9.eq_Tpe5_lC0httXz9tU-7kT9wT7a7XkWDEj0jvGSF3I',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            return  "cURL Error #:" . $err;
            //return "IMPRIMO EL ERROR";
        }
        else{
            return  $response;
            //return "IMPRIMO EL RESPONSE";
        }

    }



}