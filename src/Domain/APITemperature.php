<?php

namespace PH\Domain;


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

    /*
     * CONSEGUIR LA URL DE LAS FECHAS PARA PODER OBTENER UNA TEMPERATURA, ES LO QUE ME TOCA AHCER AHORA
     * */

    public function get_url_with_the_data($initial_date, $end_date){
        $this->setInitial_Date($initial_date);
        $this->setEnd_Date($end_date);

        $ini = $this->getInitial_Date();
        $end = $this->getEnd_Date();

        $url_aux = "https://opendata.aemet.es/opendata/api/valores/climatologicos/diarios/datos/fechaini/" . $ini . "/fechafin/" . $end . "/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJmcmFuY2lzY29yaWNvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiIxZmRmNGViMS02ZDc4LTQ0NTYtYjY3ZC0yZGJkY2FkNGQzZTEiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTU5NzM5ODc2OCwidXNlcklkIjoiMWZkZjRlYjEtNmQ3OC00NDU2LWI2N2QtMmRiZGNhZDRkM2UxIiwicm9sZSI6IiJ9.eq_Tpe5_lC0httXz9tU-7kT9wT7a7XkWDEj0jvGSF3I";
        //$url_aux = "https://opendata.aemet.es/opendata/api/valores/climatologicos/inventarioestaciones/todasestaciones/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJmcmFuY2lzY29yaWNvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiIxZmRmNGViMS02ZDc4LTQ0NTYtYjY3ZC0yZGJkY2FkNGQzZTEiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTU5NzM5ODc2OCwidXNlcklkIjoiMWZkZjRlYjEtNmQ3OC00NDU2LWI2N2QtMmRiZGNhZDRkM2UxIiwicm9sZSI6IiJ9.eq_Tpe5_lC0httXz9tU-7kT9wT7a7XkWDEj0jvGSF3I";
        // EJEMPLO DE CODIGO CLIENTE DE AEMET

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url_aux,
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
        }
        else{
            $json = file_get_contents($url_aux);
            $data = json_decode($json, true);
            $datos = $data["datos"];
            return $datos;
        }
    }

    public function get_average_temperature_from_province($url_data, $province){
        $json = file_get_contents($url_data);
        $datos = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true );
        $average_temperature_province = 0;
        $sample_size = 0;
        foreach ($datos as $dato){
            if($dato["provincia"] === $province){
                $average_temperature_province += (float) $dato['tmed'];
                $sample_size++;
            }
        }
        if($sample_size == 0){
            throw ProvinceNotFoundException::fromProvince($province);
        }
        return $average_temperature_province / $sample_size;
    }


}