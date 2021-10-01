import {csrf, loaderShow, loaderHide} from './base';

/**
 * Отправка запроса на бек
 * @param url
 * @param accessKey
 * @returns {Promise<any>}
 */
async function authRequest(url, accessKey) {
    const response = await fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": csrf,
        },
        method: "post",
        credentials: "same-origin",
        body: JSON.stringify({key: accessKey})
    });
    return await response.json();
}

/**
 * Авторизация по ключу
 * @param authRoute
 * @param accessKey
 */
export const auth = (authRoute, accessKey) => {
    if (authRoute.length && accessKey.length === 10) {
        loaderShow();
        authRequest(authRoute, accessKey).then((data) => {
            if (data.success && data.redirect) {
                self.location.href = data.redirect;
            } else {
                loaderHide();
                if (data.errors) {
                    for (const [key, value] of Object.entries(data.errors)) {
                        console.error(`${key}: ${value}`);
                    }
                }
            }
        });
    } else {
        console.error('Не верный ключ доступа', accessKey);
    }
}


