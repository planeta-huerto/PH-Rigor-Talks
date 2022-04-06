<?php

namespace PH\Temperature\Infrastructure\Service\ApiTemperature;

use HttpException;
use HttpRequest;

class ApiTemperature
{
    public function getTemperature()
    {

        $request = new HttpRequest();
        $request->setUrl('https://opendata.aemet.es/opendata/sh/ce4f05b0');
        $request->setMethod(HTTP_METH_GET);

        $request->setQueryData(array(
            'api_key' => 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ2aWNlbnRlbXVsZXJvQHBsYW5ldGFodWVydG8uZXMiLCJqdGkiOiI4OWY0NmE0MC1jNzZhLTRlMGEtOTI5MS05NmE3ZWRlNDBiZDUiLCJpc3MiOiJBRU1FVCIsImlhdCI6MTY0OTE1MjgxNCwidXNlcklkIjoiODlmNDZhNDAtYzc2YS00ZTBhLTkyOTEtOTZhN2VkZTQwYmQ1Iiwicm9sZSI6IiJ9.ZnAoBn3ukv2_4qv01jsEdmjRiO96ZhB7xofcuDZ9p3k'
        ));

        $request->setHeaders(array(
            'cache-control' => 'no-cache'
        ));

        try {
            $response = $request->send();
            $data = json_decode($response->getBody(), true);
            echo $data['tmed'];

        } catch (HttpException $ex) {
            throw new HttpException("Temperature not found");
        }
    }
}