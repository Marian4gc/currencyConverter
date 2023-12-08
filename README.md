# Currency Converter App

![currency_converter](https://github.com/Marian4gc/currencyConverter/assets/117035764/bb358d40-9c75-442c-ae48-10ba4de7575a)

Este proyecto es un sencillo convertidor de moneda construido con Symfony (backend) y React (frontend), utilizando tasas de cambio en tiempo real.

## Características

- Conversión de moneda en tiempo real.
- Utiliza la API de Open Exchange Rates para obtener las tasas de cambio.
- Mensajes de error si no se pone cantidad o si se ponen símbolos o letras.

## Requisitos

- PHP
- Composer
- Symfony CLI
- Node.js
- Yarn o npm

## Instalación

1. Clona el repositorio: `git clone https://github.com/Marian4gc/currencyConverter.git`
2. Instala las dependencias del backend: `composer install`
3. Instala las dependencias del frontend: `yarn` (o `npm install`)

## Uso

1. Inicia el servidor Symfony: `symfony server:start`
2. Inicia el servidor React: `npx encore dev --watch`

Visita `http://localhost:8000/currency/converter` en tu navegador para acceder al convertidor de moneda.

## Contribuciones

¡Las contribuciones son bienvenidas! Si encuentras algún problema o tienes alguna mejora, por favor abre un problema o envía un pull request.

## Licencia

Este proyecto está bajo la Licencia MIT - consulta el archivo [LICENSE.md](LICENSE.md) para más detalles.
