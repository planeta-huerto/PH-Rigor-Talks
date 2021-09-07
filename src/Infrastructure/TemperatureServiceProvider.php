<?php
declare(strict_types=1);

namespace PH\Infrastructure;

use PH\Application\QueryTempService;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class TemperatureServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['tempQueryService'] = function (){
            $aemetProvider = new TemperatureAEMET();
            return new QueryTempService($aemetProvider);
        };
    }
}