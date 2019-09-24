const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.scripts('node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js', 'public/js/jquery.min.js')
//     .scripts('node_modules/admin-lte/bower_components/jquery-ui/jquery-ui.min.js', 'public/js/jquery-ui.min.js')
//     .scripts('node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.min.js')
//     .scripts('node_modules/admin-lte/bower_components/raphael/raphael.min.js', 'public/js/raphael.min.js')
//     .scripts('node_modules/admin-lte/bower_components/morris.js/morris.min.js', 'public/js/morris.min.js')
//     .scripts('node_modules/admin-lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js', 'public/js/jquery.sparkline.min.js')
//     .scripts('node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js', 'public/js/jquery-jvectormap-1.2.2.min.js')
//     .scripts('node_modules/admin-lte/bower_components/jquery-knob/dist/jquery.knob.min.js', 'public/js/jquery.knob.min.js')
//     .scripts('node_modules/admin-lte/bower_components/moment/min/moment.min.js', 'public/js/moment.min.js')
//     .scripts('node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js', 'public/js/daterangepicker.js')
//     .scripts('node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js', 'public/js/bootstrap3-wysihtml5.all.min.js')
//     .scripts('node_modules/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js', 'public/js/jquery.slimscroll.min.js')
//     .scripts('node_modules/admin-lte/bower_components/fastclick/lib/fastclick.js', 'public/js/fastclick.js')
//     .scripts('node_modules/admin-lte/dist/js/adminlte.min.js', 'public/js/adminlte.min.js')
//     .scripts('node_modules/admin-lte/dist/js/pages/dashboard.js', 'public/js/dashboard.js')
//     .scripts('node_modules/admin-lte/dist/js/demo.js', 'public/js/demo.js')
//     .scripts('node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'public/js/bootstrap-datepicker.min.js')
//     .scripts('node_modules/admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js')
//     .scripts('node_modules/admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', 'public/js/dataTables.bootstrap.min.js')
//     .scripts('node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js', 'public/js/jquery-jvectormap-world-mill-en.js')
//     mix.styles([
//         'node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css',
//         'node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css',
//         'node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css',
//         'node_modules/admin-lte/dist/css/AdminLTE.min.css',
//         'node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
//         'node_modules/admin-lte/bower_components/morris.js/morris.css',
//         'node_modules/admin-lte/bower_components/jvectormap/jquery-jvectormap.css',
//         'node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
//         'node_modules/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css',
//         'node_modules/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
//         'node_modules/admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'
//     ],  'public/css/admin-tle-css.css')
mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/admin/js/admin-project-user.js', 'public/admin/js')
   .js('resources/js/admin/js/admin-task.js', 'public/admin/js')
   .js('resources/js/admin/js/file-input.js', 'public/admin/js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/mycss.scss', 'public/css/mycss.css');
