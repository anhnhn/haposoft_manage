/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require ('/node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js');
// require ('/node_modules/admin-lte/bower_components/jquery-ui/jquery-ui.min.js');
// require ('/node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js');
// require ('/node_modules/admin-lte/bower_components/raphael/raphael.min.js');
// require ('/node_modules/admin-lte/bower_components/morris.js/morris.min.js');
// require ('/node_modules/admin-lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js');
// require ('/node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');
// require ('/node_modules/admin-lte/bower_components/jquery-knob/dist/jquery.knob.min.js');
// require ('/node_modules/admin-lte/bower_components/moment/min/moment.min.js');
// require ('/node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js');
// require ('/node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
// require ('/node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');
// require ('/node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js');
// require ('/node_modules/admin-lte/dist/js/adminlte.min.js');
// require ('/node_modules/admin-lte/dist/js/pages/dashboard.js');
// require ('/node_modules/admin-lte/dist/js/demo.js');
// require ('/node_modules/admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js');
// require ('/node_modules/admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
