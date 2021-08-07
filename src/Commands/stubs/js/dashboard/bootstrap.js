window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

window.bootstrap = require('bootstrap')

window.slugify = require('slugify')
window.slugify.extend({
    'υ': 'u',
    'ύ': 'u',
    'Υ': 'u',
    'Ύ': 'U',
    'θ': 'th',
    'Θ': 'TH',
    'ξ': 'ks',
    'Ξ': 'KS',
});

window.slugifyLower = function (string) {
    return slugify(string, {lower: true})
}