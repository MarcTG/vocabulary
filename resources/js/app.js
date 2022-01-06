import { createApp, h } from 'vue'
import { createInertiaApp,Head, Link } from '@inertiajs/inertia-vue3'
import Layout from "./Shared/Layout";
import { dom } from '@fortawesome/fontawesome-svg-core'
import { library } from '@fortawesome/fontawesome-svg-core';

dom.watch()

import {
    faArrowLeft, faArrowRight, faSave, faEdit, faDotCircle, faTrash, faPlus, faChevronDown, faSearch, faShoppingCart, faTimes
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faArrowLeft, faArrowRight, faSave, faEdit, faDotCircle, faTrash, faPlus, faChevronDown, faSearch, faShoppingCart, faTimes
);

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
