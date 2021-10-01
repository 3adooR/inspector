import {auth} from './auth';

const elemAccessKey = document.querySelector('#access input');

elemAccessKey.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        let authRoute = elemAccessKey.getAttribute('data-auth-route');
        let accessKey = elemAccessKey.value;
        if (authRoute.length && accessKey.length) {
            auth(authRoute, accessKey);
        }
    }
});

elemAccessKey.focus();
