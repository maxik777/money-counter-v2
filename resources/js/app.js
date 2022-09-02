require('./bootstrap');
require('./pages/dashboard');
require('./pages/reports');
require('datatables.net-bs4');
require( 'datatables.net' );
require('/libraries/jquery-ui-1.13.1/jquery-ui')
require('/libraries/datatablesBtn')


import Alpine from 'alpinejs';
import '@themesberg/flowbite';

window.$ = window.jQuery = require("jquery");
window.toastr = require('toastr');
window.moment = require('moment/moment');
window.Alpine = Alpine;


Alpine.start();
