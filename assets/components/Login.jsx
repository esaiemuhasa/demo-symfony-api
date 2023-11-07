import React from "react";
import {Input} from "./Input";
import {Link} from "react-router-dom";

export function Login () {

    return (
        <div className="login-template">
            <header>
                <div>
                    <span className="fa fa-user-lock"></span>
                </div>
                <h1>Connectez-vous</h1>
            </header>

            <form method="POST">

                <div className={"form-group"}>
                    <Input label={"Username"} type={"text"} defaultValue={""}/>
                </div>


                <div className={"form-group"}>
                    <Input label={"Mot de passe"} type={"password"} defaultValue={""}/>
                </div>


                <div className={"form-footer"}>
                    <button type={"submit"}>
                        <span className="fa fa-check-circle"></span> Envoyer
                    </button>
                </div>

            </form>

            <footer>
                <span>ou</span>

                <div>
                    <Link to={"/"} className={"btn btn-block btn-red"}>
                        <span className="fa-brands fa-google-plus"></span> Utiliser Google
                    </Link>

                    <Link to={"/"} className={"btn btn-block btn-blue"}>
                        <span className="fi fi-brands-facebook"></span> Utiliser Facebook
                    </Link>

                    <Link to={"/"} className={"btn btn-block"}>
                        <span className="fi fi-brands-github"></span> Utiliser Github
                    </Link>
                </div>

            </footer>
        </div>
    )
}