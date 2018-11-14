
window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/**
 * Helper function for fill forms
 */
window.fillForm = function(formArray, model, method = 'POST'){
    let data = new FormData();
    data.append('_method', method);
    formArray.forEach(item => {
        data.append(item, (model[`${item}`] != undefined && model[`${item}`] != '')? model[`${item}`] : '');
});
    return data;
};

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');
Pusher.logToConsole = true;
window.Echo = new Echo({
    authEndpoint: '/broadcasting/auth',
    broadcaster: 'pusher',
    key: '4933c9f49628f6f52800',
    cluster: 'eu',
    encrypted: false
});
//
// Pusher.log = function( msg ) {
//     $(document.body).prepend( '<div>' + msg + '</div>' );
// };
// var pusher = new Pusher('');
// Pusher.log( 'key="' + pusher.key + '"' );