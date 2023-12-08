# Currency Converter App

![currency_converter](https://github.com/Marian4gc/currencyConverter/assets/117035764/bb358d40-9c75-442c-ae48-10ba4de7575a)

Esta aplicación web permite convertir montos de una moneda a otra utilizando tasas de cambio en tiempo real.

## Funcionalidades

- **Conversión de Moneda:** Convierte montos de una moneda a otra seleccionando las monedas de origen y destino.

## Cómo Usar

1. **Ingresa el Monto:** Escribe la cantidad que deseas convertir en el campo correspondiente.

2. **Selecciona las Monedas:** Escoge las monedas de origen y destino de las listas desplegables.

3. **Haz clic en Convertir:** Presiona el botón "Convertir" para obtener el resultado de la conversión.

## Tecnologías Utilizadas

- **Frontend:** React.js
- **Backend:** Symfony
- **Servicio de Conversión:** Open Exchange Rates API

## Configuración del Proyecto

1. Clona el repositorio:

    ```bash
    git clone https://github.com/tu-usuario/currency-converter.git
    ```

2. Instala las dependencias:

    ```bash
    cd currency-converter
    composer install
    cd client
    npm install
    ```

3. Configura las variables de entorno:

    Crea un archivo `.env` en la raíz del proyecto y configura las variables necesarias.

4. Inicia la aplicación:

    ```bash
    symfony serve -d
    cd client
    npm start
    ```

Visita [http://localhost:3000](http://localhost:3000) para ver la aplicación en acción.

## Contribuciones

¡Las contribuciones son bienvenidas! Si encuentras algún problema o tienes alguna mejora, por favor abre un problema o envía un pull request.

## Licencia

Este proyecto está bajo la Licencia MIT - consulta el archivo [LICENSE.md](LICENSE.md) para más detalles.
