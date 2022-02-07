import { createApp } from "vue";
import router from "./router.js";
import App from "./App.vue";

import TheModal from "./views/ui/TheModal.vue";
import Loader from "vue-spinner/src/SyncLoader.vue";

const app = createApp(App);
app.component("the-modal", TheModal);
app.component("loader", Loader);
app.use(router);

app.mount("#app");
