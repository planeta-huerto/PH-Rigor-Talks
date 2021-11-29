<?php

namespace PH\Domain\Temperature;

use Carbon\Carbon;
use GuzzleHttp\Client;

class ApiAemet
{
    // It would be great to set this variable in a .env file
    const API_KEY = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJvcnRlZ2FvcnRlZ2FkYW5pQGdtYWlsLmNvbSIsImp0aSI6IjA0NDViYzczLTU3MWQtNGRjOC05ZjkyLTFiMDY2NTI1OTcyZSIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNjM4MTc1OTI5LCJ1c2VySWQiOiIwNDQ1YmM3My01NzFkLTRkYzgtOWY5Mi0xYjA2NjUyNTk3MmUiLCJyb2xlIjoiIn0._tpniBQYhELxw48lfaApO_wvk-E4xerhfQYgbMXNDe0';
    private $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://opendata.aemet.es']);
    }

    private function aemetDateFormatted(string $date): string
    {
        return Carbon::parse($date)->toDateTimeLocalString().'UTC';
    }

    /**
     * Valores climatológicos de todas las estaciones para el rango de fechas seleccionado. Periodicidad: 1 vez al día.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getClimatologicalValueByDatesAndProvince(string $start_date, string $end_date, string $idema)
    {
        try {
            $url = '/opendata/api/valores/climatologicos/diarios/datos/fechaini/'. $this->aemetDateFormatted($start_date).
                '/fechafin/'. $this->aemetDateFormatted($end_date).'/estacion/'. $idema;

            $response = $this->client->request(
                'GET',
                $url,
                [
                    'headers' => [
                        'api_key' => self::API_KEY
                    ]
                ]
            );

            if ($response->getBody()) {
                $data = json_decode($response->getBody(), true);

                if (empty($data['datos'])) {
                    throw new \Exception('There is no data for given params');
                }

                return $data['datos'];
            }
        } Catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
