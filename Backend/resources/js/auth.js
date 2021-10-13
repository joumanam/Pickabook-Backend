class Auth {
    constructor() {
        this.auth = false;
    }

    login(data) {
        const tmrw = new Date();
        tmrw.setTime(tmrw.getTime() + 24 * 60 * 60 * 1000);
        this.auth = true;
        localStorage.setItem("token", data.access_token);
        localStorage.setItem("token_expiary", tmrw.toLocaleTimeString());
        localStorage.setItem("user", JSON.stringify(data.user));
    }

    logout() {
        this.auth = false;
        localStorage.removeItem("token");
        localStorage.removeItem("token_expiary");
        localStorage.removeItem("user");
    }

    isAuth() {
        return this.auth;
    }
}

export default new Auth();
