import React, { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { auth, emailPasswordSignIn, signInWithGoogle } from "./firebase";
import { useAuthState } from "react-firebase-hooks/auth";
import "./Login.css";
import { signInWithEmailAndPassword } from "@firebase/auth";

function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    //const [user, loading, error] = useAuthState(auth);
    const history = useNavigate();
    /*useEffect(() => {
        if (loading) {
            return;
        }
        if (user) history.replace("/dashboard");
    }, [user, loading]);*/
    return (
        <div className="login">
            <div className="login__container">
                <button className="login__btn login__google" onClick={signInWithGoogle}>Login with Google</button>
            </div>
        </div>
    );
}
export default Login;