import "../css/app.css";
import "./bootstrap";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h, watch } from "vue";
import { createPinia } from "pinia";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        const app = createApp({ render: () => h(App, props) })
            .use(pinia)
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
        watch(
            () => pinia.state.user,
            (user) => {
                if (user) {
                    localStorage.setItem("user", JSON.stringify(user));
                }
            }
        );
        return app;
    },
    progress: {
        color: "#4B5563",
    },
});
