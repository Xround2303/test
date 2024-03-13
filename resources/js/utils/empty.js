export default function empty(e) {

    if(Array.isArray(e) && e.length === 0) {
        return true;
    }

    switch (e) {
        case "":
        case 0:
        case "0":
        case null:
        case false:
        case undefined:
            return true;
        default:
            return false;
    }
}
