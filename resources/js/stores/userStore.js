import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    persist: true,
    // other options...
    state: () => {
        const user = sessionStorage.getItem("user")
            ? JSON.parse(sessionStorage.getItem("user"))
            : {
                  id: null,
                  firstName: null,
                  lastName: null,
                  username: null,
              };
        return user;
    },
    getters: {
        isLoggedIn: (state) => !!state.user,
    },
    actions: {
        setUser(user) {
            this.user = {
                ...user,
                firstName: user.first_name,
                lastName: user.last_name,
            };
            console.log("setUser", this.user);
            sessionStorage.setItem("user", JSON.stringify(this.user));
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
