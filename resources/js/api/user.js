import axios from "axios";

export function login(data) {
    return axios.post("/api/login", data, {
        headers: { "Content-Type": "application/form-data" },
    });
}

export function register(data) {
    return axios.post("/api/register", data, {
        headers: { "Content-Type": "application/form-data" },
    });
}

// if default value is "", then it will return the current user profile
export function getProfile(userId = undefined) {
    return axios.get("/api/users/" + userId);
}
