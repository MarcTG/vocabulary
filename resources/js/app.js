import { createApp, h } from 'vue'
import { createInertiaApp,Head, Link } from '@inertiajs/inertia-vue3'
import Layout from "./Shared/Layout";
import { dom } from '@fortawesome/fontawesome-svg-core'
import { library } from '@fortawesome/fontawesome-svg-core';
import { InertiaProgress } from '@inertiajs/progress'
import mitt from 'mitt';

InertiaProgress.init({
    showSpinner: true,
})
dom.watch()

import {
    faArrowLeft, faArrowRight, faSave, faEdit, faDotCircle, faTrash, faPlus, faChevronDown, faSearch, faShoppingCart, faTimes, faExclamationTriangle, faCheckCircle
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faArrowLeft, faArrowRight, faSave, faEdit, faDotCircle, faTrash, faPlus, faChevronDown, faSearch, faShoppingCart, faTimes, faExclamationTriangle, faCheckCircle
);

const emitter = mitt();

createInertiaApp({
    resolve: async name => {
        let page = (await import(`./Pages/${name}`)).default;

        if (page.layout === undefined) {
            page.layout = Layout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component( "Head", Head)

        app.config.globalProperties.emitter = emitter;
        app.mount(el);
    },
})
