
import './styles/app.scss';

import React from "react";
import ReactDOM from "react-dom/client"
import {createBrowserRouter, RouterProvider} from "react-router-dom";
import {App} from "./components/App";
import {Home} from "./pages/Home";
import {Aboute} from "./pages/Aboute";
import {Login} from "./components/Login";

const router = createBrowserRouter([
    {
        path: '/',
        element: <App/>,
        children: [
            {
                path: '',
                element: <Home/>
            },
            {
                path: 'aboute',
                element: <Aboute/>
            }
        ]
    },
    {
        path: '/app/login',
        element: <Login/>
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