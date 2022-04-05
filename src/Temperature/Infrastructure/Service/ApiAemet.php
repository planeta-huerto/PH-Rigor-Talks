<?php

namespace PH\Temperature\Infrastructure\Service;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use PH\Date\Domain\Date;

class ApiAemet
{
    const API_KEY = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ5YW1hbG5pZXRvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiJlZjg5ZjY0YS0zM2JmLTRkYmQtODY1My04NTYyNDJmODc2M2YiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTY0OTE0NDMxMiwidXNlcklkIjoiZWY4OWY2NGEtMzNiZi00ZGJkLTg2NTMtODU2MjQyZjg3NjNmIiwicm9sZSI6IiJ9.bf53qRMKKxucu95vIGZNkasSyw8-6UUbbdfsFWBLHEw';
    const DOMAIN = 'https://opendata.aemet.es';
    const ALICANTE_STATION = '7247X';
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::DOMAIN
        ]);
    }

    public function getClimatologicalValuesByDatesAndStation(Date $startDate, Date $endDate, string $station)
    {
        $this->checkDatesAreValid($startDate, $endDate);

        $response = $this->getResponse($startDate, $endDate, $station);

        $data = json_decode($response->getBody(), true);

        $data = $this->checkDataIsEmpty($data);

        return $data['datos'];
    }

    /**
     * @throws Exception
     */
    private function checkDatesAreValid(Date $startDate, Date $endDate)
    {
        if ($startDate > $endDate) {
            throw new Exception('Dates not valid.');
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $station
     * @return Response
     * @throws GuzzleException
     */
    private function getResponse($startDate, $endDate, $station): Response
    {
        $url = '/opendata/api/valores/climatologicos/diarios/datos/fechaini/' . $startDate .
            '/fechafin/' . $endDate . '/estacion/' . $station;

        return $this->client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'api_key' => self::API_KEY
                ]
            ]
        );
    }

    /**
     * @throws Exception
     */
    private function checkDataIsEmpty($data)
    {
        if (empty($data['datos'])) {
            throw new Exception('No data was received');
        }
        return $data;
    }
}