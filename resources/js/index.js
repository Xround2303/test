import {createApp} from "vue";
import "./assets/css/main.css";
import store from "./store";
import router from "./router";
import PrimeVue from 'primevue/config';
import {isAuthObjectValidate} from "./utils/request";
import ToastService from 'primevue/toastservice';
import 'primevue/resources/themes/lara-light-green/theme.css'
import Index from  "./component/page/Index.vue";
import Empty from  "./component/page/Empty.vue";
import  "./utils/calcAppMinHeight";
import { library } from "@fortawesome/fontawesome-svg-core"
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome"
import {fas} from "@fortawesome/free-solid-svg-icons"
import 'primeicons/primeicons.css'

library.add(fas)


function buildComponentIndex()
{
    if(isAuthObjectValidate()) {
        return Index;
    }

    return Empty;
}



// Загрузка базовых параметров приложения
store.dispatch("setting/fetchAppSettingList").then(e => {
    store.commit("setting/updateUserPermissionGroup", e.user_permission_group)
    store.commit("setting/updateIsAppInstalled", e.is_app_installed)
    store.commit("setting/updateDomain", e?.domain)
    store.commit("setting/updateAppId", e?.app_id)
    store.commit("setting/updateUserId", e?.user_id)
    store.commit("setting/updateModuleCode", e?.module_code)
}).then(() => {
    createApp(buildComponentIndex() )
        .use(router)
        .use(store)
        .use(PrimeVue)
        .use(ToastService)
        .component('font-awesome-icon', FontAwesomeIcon)
        .mount('#app');
})


