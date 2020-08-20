<?php


namespace PH\Domain;

final class ProvinceNotFoundException extends \Exception
{
    public static function fromProvince($province) {
        return new static(
            sprintf('%d province is not in the data', $province)
        );
    }
}