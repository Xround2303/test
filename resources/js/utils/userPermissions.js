import store from "../store";
import router from "../router";

export function checkUserPermissionByName(routeName) {
    const routePermission = router.resolve({name: routeName}).meta.permissions
    const userPermission = store.state.setting.userPermissionGroup

    return checkUserPermission(routePermission, userPermission)
}

export function checkUserPermission(routePermissions, userPermission) {
    return routePermissions.includes(userPermission) || routePermissions.length === 0
}

