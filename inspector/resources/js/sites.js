import {loaderShow} from './base';

document.querySelectorAll('.sites-item-delete').forEach(item => {
    item.addEventListener('click', () => loaderShow());
});
