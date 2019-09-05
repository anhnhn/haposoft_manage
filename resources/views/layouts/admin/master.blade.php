<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset("css/admin-tle-css.css") }}">
    <link rel="stylesheet" href="{{ asset("css/mycss.css") }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <title>@yield('title')</title>
</head>
<body class="hold-transition skin-blue sidebar-mini set-height">
<header class="main-header">
    <a href="{{ route('admins.dashboard') }}" class="logo">
        <span class="logo-mini"><b>A</b>LT</span>
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ Auth::user()['name'] }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <a class="btn btn-default btn-flat"
                                   href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="wrapper set-height">
    <aside class="main-sidebar">
        <section class="sidebar">
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="{{ route('admins.dashboard') }}">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
                        <li><a href="{{ route('departments.index') }}"><i class="fa fa-circle-o"></i> Departments</a></li>
                        <li><a href="{{ route('projects.index') }}"><i class="fa fa-circle-o"></i> Projects</a></li>
                        <li><a href="{{ route('customers.index') }}"><i class="fa fa-circle-o"></i> Customers</a></li>
                        <li><a href="{{ route('reports.index') }}"><i class="fa fa-circle-o"></i> Reports</a></li>
                        <li><a href="{{ route('tasks.index') }}"><i class="fa fa-circle-o"></i> Tasks</a></li>
                    </ul>
                </li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Assign</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('projectuser.index') }}"><i class="fa fa-circle-o"></i>Projects</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </aside>
    <div>
        @yield('content')
    </div>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
</footer>
<div class="control-sidebar-bg"></div>
</div>
</body>
<script src="{{ asset("js/jquery.min.js") }}"></script>
<script src="{{ asset("js/jquery-ui.min.js") }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("js/raphael.min.js") }}"></script>
<script src="{{ asset("js/morris.min.js") }}"></script>
<script src="{{ asset("js/jquery.sparkline.min.js") }}"></script>
<script src="{{ asset("js/jquery-jvectormap-1.2.2.min.js") }}"></script>
<script src="{{ asset("js/jquery-jvectormap-world-mill-en.js") }}"></script>
<script src="{{ asset("js/jquery.knob.min.js") }}"></script>
<script src="{{ asset("js/moment.min.js") }}"></script>
<script src="{{ asset("js/daterangepicker.js") }}"></script>
<script src="{{ asset("js/bootstrap-datepicker.min.js") }}"></script>
<script src="{{ asset("js/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script src="{{ asset("js/jquery.slimscroll.min.js") }}"></script>
<script src="{{ asset("js/fastclick.js") }}"></script>
<script src="{{ asset("js/adminlte.min.js") }}"></script>
<script src="{{ asset("js/dashboard.js") }}"></script>
<script src="{{ asset("js/demo.js") }}"></script>
<script src="{{ asset("js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("js/jquery.dataTables.min.js") }}"></script>
<script src="{{ asset("admin/js/admin-department.js") }}"></script>
<script src="{{ asset("admin/js/admin-task.js") }}"></script>
<script src="{{ asset("admin/js/admin-project-user.js") }}"></script>