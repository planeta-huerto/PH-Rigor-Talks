<?php
declare(strict_types=1);

namespace PH\Infrastructure;

final class TemperatureAEMET
{
    public function __construct()
    {
    }

    public function getTemperature()
    {
        $url = $this->getUrlIdEma("8025");

        $curl = curl_init();
        $this->setCurltOpt($curl, $url);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("No se ha podido obtener la temperatura");
        } else {
            $result = json_decode($response);
            return $result[0]->ta;
        }
    }

    private function getUrlIdEma($idema){
        $url = "https://opendata.aemet.es/opendata/api/observacion/convencional/datos/estacion/" . $idema;
        $key = "eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbnRvbmlvY2Fub0BwbGFuZXRhaHVlcnRvLmVzIiwianRpIjoiZjkwNDFiZjktY2E4ZS00OTllLWI2YzUtOTcwODJhZGNjNTY1IiwiaXNzIjoiQUVNRVQiLCJpYXQiOjE2MzA5MTA3OTUsInVzZXJJZCI6ImY5MDQxYmY5LWNhOGUtNDk5ZS1iNmM1LTk3MDgyYWRjYzU2NSIsInJvbGUiOiIifQ.P9TQOmRVrb8kElJhNATm8wqHNNfA8GfRyM-fLLrfdPk";
        $fullCurlURL = "$url/?api_key=$key";

        $curl = curl_init();
        $this->setCurltOpt($curl, $fullCurlURL);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("No se ha podido obtener la URL");
        }

        $result = json_decode($response);
        return $result->datos;
    }

    private function setCurltOpt($curl, $url){
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
    }
}