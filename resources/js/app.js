require('./bootstrap');
require('./pages/dashboard');
require('./pages/reports');
require('datatables.net-bs4');
require( 'datatables.net' );


import Alpine from 'alpinejs';
import '@themesberg/flowbite';

window.$ = window.jQuery = require("jquery");
window.toastr = require('toastr');
window.moment = require('moment/moment');
window.Alpine = Alpine;


Alpine.start();
