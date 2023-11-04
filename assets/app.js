
import './styles/app.scss';

import React from "react";
import ReactDOM from "react-dom/client"
import {createBrowserRouter, RouterProvider} from "react-router-dom";
import {App} from "./components/App";

const router = createBrowserRouter([
    {
        path: '/',
        element: <App/>
    }
]);

document.addEventListener('DOMContentLoaded', () => {
    const root = document.getElementById('root')
    ReactDOM.createRoot(root).render(
        <React.StrictMode>
            <RouterProvider router={router}/>
        </React.StrictMode>
    )
})