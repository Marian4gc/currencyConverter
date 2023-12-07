/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import React from 'react';
// import ReactDOM from 'react-dom/client';
import ReactDOM from 'react-dom';
import ConverterForm from './components/ConverterForm';
import './styles/app.css';

// Renderiza el componente ConverterForm en el elemento con id "root"
ReactDOM.render(<ConverterForm />, document.getElementById('root'));

// document.addEventListener('DOMContentLoaded', function () {
//     // Obtén el contenedor del documento
//     const container = document.getElementById('root');

//     // Renderiza el componente ConverterForm en el contenedor
//     const root = ReactDOM.createRoot(container);
//     root.render(<ConverterForm />);
// });
