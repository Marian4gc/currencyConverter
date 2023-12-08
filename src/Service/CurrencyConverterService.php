<?php

namespace App\Service;

class CurrencyConverterService
{
    private $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }
    
    private const API_BASE_URL = 'https://open.er-api.com/v6/latest/EUR';

    public function getCurrencies(): array
{
    //Llamada a la API
    $conversionJson = file_get_contents(self::API_BASE_URL);

    //si la API devuelve datos válidos
    $conversionData = json_decode($conversionJson, true);
    
    //hay tasas de cambio en la respuesta
    if (!isset($conversionData['rates'])) {
        return [];
    }
    //devolver todas las monedas
    return array_keys($conversionData['rates']);
}


    public function convertCurrency($amount, $currencyFrom, $currencyTo): ?string
    {
        //URL de la API
        $url = self::API_BASE_URL . $currencyFrom;

        //obtener las tasas de cambio
        $conversionJson = file_get_contents($url);

        //si datos válidos
        $conversionData = json_decode($conversionJson, true);
        if (!isset($conversionData['rates'])) {
            return null;
        }

        //ver si está la moneda
        if (!isset($conversionData['rates'][$currencyFrom])) {
            return null;
        }

        //la tasa de cambio
        $conversionRateFrom = $conversionData['rates'][$currencyFrom];

        // Ver si la moneda
        if (!isset($conversionData['rates'][$currencyTo])) { 
            return null;
        }

        //la tasa de cambio
        $conversionRateTo = $conversionData['rates'][$currencyTo];

        // Realiza la conversión con dos decimales
        $convertedAmount = number_format(($amount / $conversionRateFrom) * $conversionRateTo, 2);

        return $convertedAmount;
    }
}