import React from "react";
import ReactDOM from "react-dom";
import Login from "./pages/Login";
import Messages from "./pages/Messages";
import Images from "./pages/Images";
import {
    BrowserRouter as Router,
    HashRouter,
    Switch,
    Route,
    Redirect,
} from "react-router-dom";
import auth from "./auth";
import "react-toastify/dist/ReactToastify.min.css";
import { ProtectedRoute } from "./protected.route";

export default function App() {
    return (
        <Switch>
            <Route exact path="/" render={(props) => <Login />} />
            <ProtectedRoute exact path="/images" component={Images} />
            <ProtectedRoute exact path="/messages" component={Messages} />
            <Route exact path="/logout" />
            <Route path="*" component={() => "404 Not Found!"} />
        </Switch>
    );
}

if (document.getElementById("App")) {
    ReactDOM.render(
        <HashRouter>
            <React.StrictMode>
                <App />
            </React.StrictMode>
        </HashRouter>,
        document.getElementById("App")
    );
}
