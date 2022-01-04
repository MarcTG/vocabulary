import { createApp, h } from 'vue'
import { createInertiaApp,Head, Link } from '@inertiajs/inertia-vue3'
import Layout from "./Shared/Layout";

createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if (page.layout === undefined) {
            page.layout = Layout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component( "Head", Head)
            .mount(el)
    },
})
