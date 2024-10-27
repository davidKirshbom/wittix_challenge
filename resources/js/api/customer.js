export function addCustomer(data) {
    return axios.post("/api/customers", data, {
        headers: { "Content-Type": "application/form-data" },
    });
}
