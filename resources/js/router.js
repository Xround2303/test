import { createWebHistory, createRouter } from "vue-router";
import store from "./store"
import Home from  "./component/page/Home.vue";
import Setting from "./component/page/Setting.vue";
import Empty from "./component/page/Empty.vue";
import Install from "./component/page/Install.vue";
import LayoutDefault from "./component/layout/LayoutDefault.vue";
import LayoutEmpty from "./component/layout/LayoutEmpty.vue";
import {checkUserPermission} from "./utils/userPermissions";

const route = function (name, path, component, permissions, layout = LayoutDefault) {
    return {
        name: name,
        path: path,
        component: component,
        meta: {
            permissions: permissions,
            checkPermissions: function () {
                return checkUserPermission(
                    this.permissions,
                    store.state.setting.userPermissionGroup
                )
            },
            layout: layout
        },
    }
}

const routes = [
    route("404", "/:pathMatch(.*)*", Empty, [], LayoutEmpty),
    route("index", "/", Home, []),
    route("setting", "/setting/", Setting, ['A']),
    route("install", "/install/", Install, ['A'], LayoutEmpty),

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    if(!to.meta.checkPermissions()) {
        if(store.state.setting.isAppInstalled) {
            next({name: "index"})
        } else {
            next({name: "404"})
        }
    } else {
        next()
    }
    // !to.meta.checkPermissions() ? next({name: "index"}) : next();
})

export default router;
