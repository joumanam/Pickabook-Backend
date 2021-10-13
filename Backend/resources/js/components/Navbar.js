import React from "react";
import { NavLink } from "react-router-dom";
import auth from "../auth";

export default function Navbar() {
    const logout = async () => {
        axios
            .post(
                "http://localhost:8000/api/auth/logout",
                {},
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token"
                        )}`,
                    },
                }
            )
            .then((response) => {
                auth.logout();
            });
    };
    return (
        <div>
            <nav className="navbar custom__navbar navbar-expand-lg navbar-dark mb-5">
                <div
                    className="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2"
                    id="navbarSupportedContent"
                >
                    <ul className="navbar-nav mr-auto">
                        <li className="nav-item custom__navbar__link">
                            <NavLink
                                className="nav-link custom__navbar__link--a"
                                to="/images"
                            >
                                Images
                            </NavLink>
                        </li>
                        <li className="nav-item custom__navbar__link">
                            <NavLink
                                className="nav-link custom__navbar__link--a"
                                to="/messages"
                            >
                                Messages
                            </NavLink>
                        </li>
                    </ul>
                </div>
                <div className="mr-auto ml-1 my-1 order-0">
                    <button
                        className="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target=".dual-collapse2"
                    >
                        <span className="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div className="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul className="navbar-nav ml-auto ">
                        <li className="nav-item custom__navbar__link">
                            <NavLink
                                className="nav-link custom__navbar__link--a"
                                to="/"
                                onClick={logout}
                            >
                                Logout
                            </NavLink>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    );
}
