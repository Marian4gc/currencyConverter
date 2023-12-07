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
    // Llama a la API para obtener las tasas de cambio
    $conversionJson = file_get_contents(self::API_BASE_URL);

    // Verifica si la API devuelve datos válidos
    $conversionData = json_decode($conversionJson, true);
    
    // Verifica si hay tasas de cambio en la respuesta
    if (!isset($conversionData['rates'])) {
        return [];
    }

    // Devuelve todas las monedas presentes en las tasas de cambio
    return array_keys($conversionData['rates']);
}



    public function convertCurrency($amount, $currencyFrom, $currencyTo): ?string
    {
        // Construye la URL de la API para obtener las tasas de cambio específicas
        $url = self::API_BASE_URL . $currencyFrom;

        // Llama a la API para obtener las tasas de cambio
        $conversionJson = file_get_contents($url);

        // Verifica si la API devuelve datos válidos
        $conversionData = json_decode($conversionJson, true);
        if (!isset($conversionData['rates'])) {
            return null;
        }

        // Verifica si la moneda de origen está presente en las tasas de cambio
        if (!isset($conversionData['rates'][$currencyFrom])) {
            return null;
        }

        // Obtén la tasa de cambio específica
        $conversionRateFrom = $conversionData['rates'][$currencyFrom];

        // Verifica si la moneda de destino está presente en las tasas de cambio
        if (!isset($conversionData['rates'][$currencyTo])) {
            return null;
        }

        // Obtén la tasa de cambio específica
        $conversionRateTo = $conversionData['rates'][$currencyTo];

        // Realiza la conversión
        $convertedAmount = number_format(($amount / $conversionRateFrom) * $conversionRateTo, 2);

        return $convertedAmount;
    }
}