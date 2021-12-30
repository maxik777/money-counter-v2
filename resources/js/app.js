require('./bootstrap');
require('./pages/dashboard')

import Alpine from 'alpinejs';
import '@themesberg/flowbite';

window.$ = window.jQuery = require("jquery");
window.toastr = require('toastr');
window.Alpine = Alpine;


Alpine.start();
