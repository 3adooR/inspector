/** CSRF-token **/
export const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

/** ID loader element **/
const loaderID = 'loader';

/** Add loader overlay **/
export const loaderShow = () => {
    let loader = document.createElement('div');
    loader.setAttribute('id', loaderID);
    loader.innerHTML = `<svg version="1.1" id="L6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
       <rect fill="none" stroke="#fff" stroke-width="4" x="25" y="25" width="50" height="50">
        <animateTransform
         attributeName="transform"
         dur="0.5s"
         from="0 50 50"
         to="180 50 50"
         type="rotate"
         id="strokeBox"
         attributeType="XML"
         begin="rectBox.end"/>
        </rect>
        <rect x="27" y="27" fill="#fff" width="46" height="50">
        <animate
         attributeName="height"
         dur="1.3s"
         attributeType="XML"
         from="50"
         to="0"
         id="rectBox"
         fill="freeze"
         begin="0s;strokeBox.end"/>
         </rect>
    </svg>`;
    document.body.append(loader);
}

/** Remove loader **/
export const loaderHide = () => document.getElementById(loaderID).remove();

