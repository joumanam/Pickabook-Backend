import React from "react";
import auth from "../auth";
import { useState } from "react";
import axios from "axios";
import { Redirect } from "react-router";
import { ToastContainer, toast } from "react-toastify";

const Login = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [redirect, setRedirect] = useState(false);
    const submit = async (event) => {
        event.preventDefault();

        await axios
            .post("http://localhost:8000/api/auth/admin/login", {
                email,
                password,
            })
            .then((response) => {
                let code = response.data.code;
                if (parseInt(code) !== 200) {
                    if (parseInt(code) == 401) {
                        throw new Error("Unauthorized");
                    }
                    if (parseInt(code) == 422) {
                        throw new Error("Password or Email are wrong!");
                    }
                }
                toast.success("Successfully logged in");
                auth.login(response.data);
                setRedirect(true);
            })
            .catch((err) => {
                toast.error(err.toString());
            });
    };

    if (redirect) {
        return <Redirect to="/images" />;
    }
    return (
        <>
            <div className="container mt-5">
                <div className="row">
                    <div className="col-sm"></div>
                    <div className="col p-5 rounded custom_col">
                        <div className="d-flex justify-content-center mb-5 ">
                            <div className="logo_img"></div>
                        </div>
                        <form onSubmit={submit}>
                            <div className="form-group">
                                <input
                                    type="email"
                                    className="form-control"
                                    onChange={(e) => setEmail(e.target.value)}
                                    placeholder="Email"
                                />
                            </div>

                            <div className="form-group">
                                <input
                                    type="password"
                                    className="form-control"
                                    onChange={(e) =>
                                        setPassword(e.target.value)
                                    }
                                    placeholder="Password"
                                />
                            </div>

                            <button
                                type="submit"
                                className="btn custom__btn btn-block"
                            >
                                Submit
                            </button>
                        </form>
                    </div>
                    <div className="col-sm"></div>
                </div>
            </div>
            <ToastContainer
                position="bottom-center"
                icon={false}
                autoClose={2000}
            />
        </>
    );
};

export default Login;
