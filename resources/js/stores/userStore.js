import { getProfile } from "@/api/user";
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    persist: true,
    // other options...
    state: () => {
        const user = sessionStorage.getItem("user")
            ? JSON.parse(sessionStorage.getItem("user"))
            : {
                  id: null,
                  name: null,
                  email: null,
                  firstName: null,
                  lastName: null,
                  userIdentifier: null,
              };
        return user;
    },
    getters: {
        isLoggedIn: (state) => !!state.user,
    },
    actions: {
        setUser(user) {
            debugger;
            this.user = {
                ...user,
                userIdentifier: user.user_identifier,
                firstName: user.first_name,
                lastName: user.last_name,
            };
            this.user.customers = user.customers.map((customer) => ({
                ...customer,
                firstName: customer.first_name,
                lastName: customer.last_name,
            }));
            sessionStorage.setItem("user", JSON.stringify(this.user));
        },
        async refreshUserData() {
            const response = await getProfile();
            debugger;
            this.setUser(response.data.user);
        },
        logout() {
            this.user = {
                id: null,
                name: null,
                email: null,
                firstName: null,
                lastName: null,
                userIdentifier: null,
            };
            sessionStorage.removeItem("user");
        },
    },
});
