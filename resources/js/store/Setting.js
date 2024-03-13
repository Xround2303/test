import {request} from "../utils/request"
import empty from "../utils/empty";

export default {

    namespaced: true,

    state() {
        return {
            // Домен портала
            domain: null,

            // Ид приложения на портале
            appId: null,

            // код модуля
            moduleCode: null,

            // Ид пользователя на портале
            userId: null,

            // Группа пользователя
            userPermissionGroup: null,

            // Приложение установлено
            isAppInstalled: false
        }
    },
    mutations: {
        updateDomain(state, value)
        {
            state.domain = value;
        },
        updateAppId(state, value)
        {
            state.appId = value;
        },
        updateUserId(state, value)
        {
            state.userId = value;
        },
        updateModuleCode(state, value)
        {
            state.moduleCode = value;
        },
        updateUserPermissionGroup(state, value)
        {
            state.userPermissionGroup = value;
        },
        updateIsAppInstalled(state, value)
        {
            state.isAppInstalled = value;
        }
    },
    actions: {
        async fetchAppSettingList(context, payload)
        {
            return request("/api/app/setting/list/", {
                method: "GET"
            })
        },
    },
    getters: {
        IS_ADMIN(state, getters)
        {
            return state.userPermissionGroup === "A";
        }
    }
}
