import {createStore, mapState} from "vuex";
import Setting from "./store/Setting.js";

export default createStore({
    modules: {
        setting: Setting,
    },
    actions: {

    },
    getters: {
        PLACEMENT_OPTIONS() {
            return PLACEMENT_OPTIONS
        },
        AUTH_OBJECT() {
            return AUTH_OBJECT
        }
    }
})
