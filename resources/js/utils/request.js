export async function request (path, config) {
    let params = (new URLSearchParams(AUTH_OBJECT)).toString();

    return await fetch(path + "?" + params.toString(), config)
        .then(response => response.json())
        .then(response => {
            if(response?.status === 'success') {
                return response.data;
            }

            throw new Error(response.data)
        })

}

export function isAuthObjectValidate()
{
    return !!(AUTH_OBJECT.AUTH_ID && AUTH_OBJECT.member_id)
}
