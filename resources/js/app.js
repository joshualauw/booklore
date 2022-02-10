import { createApp } from "vue";
import router from "./router.js";
import App from "./App.vue";

import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import TheModal from "./views/ui/TheModal.vue";
import Loader from "vue-spinner/src/SyncLoader.vue";

const app = createApp(App);
app.component("the-modal", TheModal);
app.component("loader", Loader);
app.component("quill-editor", QuillEditor);
app.use(router);

app.mount("#app");
