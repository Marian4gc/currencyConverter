import React, { useState } from "react";
import '../styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';

const ConverterForm = () => {

    const [amount, setAmount] = useState('');
    const [currencyFrom, setCurrencyFrom] = useState('EUR');
    const [currencyTo, setCurrencyTo] = useState('EUR');
    const [result, setResult] = useState(null);
    const [error, setError] = useState(null);

    // Lista de monedas
    const currencies = ['EUR', 'USD', 'GBP', 'JPY', 'AUD'];



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
        <>
            <div className="card p-5 text-center rounded-3 mx-auto" style={{width: '30rem', marginTop: '2rem'}}>

                    <h1 style={{ fontFamily: 'Roboto, sans-serif' }}>Currency Converter</h1>

                    <img src="/images/coins.svg"
                    className="rounded mt-5"
                    alt="coins change"
                    style={{ maxWidth: '100%', height: '10em' }}/>

                    <form onSubmit={handleSubmit} noValidate>

                        <div className="input-container mt-5">
                            <input
                                type="text"
                                id="amount"
                                value={amount}
                                onChange={(e) => setAmount(e.target.value)}
                                required
                            />
                            <label htmlFor="amount" className="label">Amount</label>
                            <div className="underline"></div>
                        </div>

                        <br />

                        <div className="d-inline-flex gap-5 mb-3 mt-3">
                            <label>
                                <select
                                    className="form-select"
                                    aria-label="Default select example"
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

                            <img src="/images/equal.svg"
                                    className="rounded"
                                    alt="symbol equal"
                                    style={{ maxWidth: '100%', height: '2em' }}/>

                            <label>
                                <select
                                    className="form-select"
                                    aria-label="Default select example"
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
                        </div>

                        <br />
                        <button
                            type="submit">Convert</button>
                    </form>

                    {/* resultado y mensaje de error */}
                    {error && <p style={{ color: 'red' }}>{error}</p>}
                    {result !== null && <p className="result">Result: {result}</p>}
                </div>
        </>
    );
};

export default ConverterForm;