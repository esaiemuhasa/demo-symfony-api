import React from "react";
import {NavLink, Outlet} from "react-router-dom";

export function App () {

    return(
        <>
            <Header/>
            <Outlet/>
        </>
    );
}


function Header () {


    return (
        <header className="layout-header">
            <div className="header-container">
                <div className="site-name">
                    <h1>Un Site Bidon!</h1>
                    <small>Comment ça, il n'y a presque rien?</small>
                </div>

                <div>
                    <NavLink to={"/app/login"} className={"btn"}>Me connecter</NavLink>
                </div>

                <nav>
                    <ul>
                        <li>
                            <NavLink to={"/"}>Actualité</NavLink>
                        </li>
                        <li>
                            <NavLink to={"/aboute"}>Apropos</NavLink>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    )
}