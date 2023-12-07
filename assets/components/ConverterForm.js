import React, { useState, useEffect } from "react";

const ConverterForm = () => {
    // Estado para almacenar los valores del formulario
    const [amount, setAmount] = useState('');
    const [currencyFrom, setCurrencyFrom] = useState('EUR');
    const [currencyTo, setCurrencyTo] = useState('EUR');
    const [result, setResult] = useState(null);
    const [error, setError] = useState(null);

    // Lista de monedas (puedes obtenerla desde Symfony o configurarla manualmente)
    const currencies = ['EUR', 'USD', 'GBP', 'JPY', 'AUD'];



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
                const errorData = await response.json();
                throw new Error(errorData.error);
            }
    
            const result = await response.json();
            setResult(result.convertedAmount);
            setError(null);
        } catch (error) {
            console.error('Error during form submission:', error.message);
            setError(error.message);
        }
    };

    return (
        <div>
            <form onSubmit={handleSubmit}>
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
                <button type="submit">Convert</button>
            </form>

            {/* resultado y mensaje de error */}
            {error && <p style={{ color: 'red' }}>{error}</p>}
            {result !== null && <p>Result: {result}</p>}
        </div>
    );
};

export default ConverterForm;