import axios from "axios";

export async function login(data) {
    return axios.post("/api/login", data, {});
}

export async function register(data) {
    return axios.post("/api/register", data);
}

export function usersList() {
    return axios.get("/api/users");
}

export function deleteUser(id) {
    return axios.delete(`/api/users/${id}`);
}
