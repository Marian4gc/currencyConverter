import React, { useState, useEffect } from "react";

const ConverterForm = () => {
    // Estado para almacenar los valores del formulario
    const [amount, setAmount] = useState('');
    const [currencyFrom, setCurrencyFrom] = useState('');
    const [currencyTo, setCurrencyTo] = useState('');
    const [result, setResult] = useState(null);

    // Lista de monedas (puedes obtenerla desde Symfony o configurarla manualmente)
    const currencies = ['USD', 'EUR', 'GBP', 'JPY', 'AUD'];

    // Función para manejar el envío del formulario
    const handleSubmit = async (event) => {
        event.preventDefault();
    
        try {
            const response = await fetch('/api/convert', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: amount,
                    currencyFrom: currencyFrom,
                    currencyTo: currencyTo,
                }),
            });
    
            if (!response.ok) {
                throw new Error(`Error: ${response.statusText}`);
            }
    
            const result = await response.json();
            setResult(result.convertedAmount);
        } catch (error) {
            console.error('Error during form submission:', error);
        }
    };

    return (
        <div>
            <form onSubmit={handleSubmit}>
                {/* Campos del formulario */}
                <label>
                    Amount:
                    <input
                        type="text"
                        value={amount}
                        onChange={(e) => setAmount(e.target.value)}
                    />
                </label>
                <br />
                <label>
                    Currency From:
                    <select
                        value={currencyFrom}
                        onChange={(e) => setCurrencyFrom(e.target.value)}
                    >
                        {currencies.map((currency) => (
                            <option key={currency} value={currency}>
                                {currency}
                            </option>
                        ))}
                    </select>
                </label>
                <br />
                <label>
                    Currency To:
                    <select
                        value={currencyTo}
                        onChange={(e) => setCurrencyTo(e.target.value)}
                    >
                        {currencies.map((currency) => (
                            <option key={currency} value={currency}>
                                {currency}
                            </option>
                        ))}
                    </select>
                </label>
                <br />
                {/* Botón de envío */}
                <button type="submit">Convert</button>
            </form>

            {/* Muestra el resultado */}
            {result !== null && <p>Result: {result}</p>}
        </div>
    );
};

export default ConverterForm;
