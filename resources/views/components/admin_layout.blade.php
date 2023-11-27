<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="../../adminlte/img/vsu.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PCBMS</title>
{{-- #region Links --}}
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../adminlte/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
{{-- #endregion --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
    <x-nav_bar>
    </x-nav_bar>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="../../adminlte/img/AdminLTELogo.png" alt="PCBMS Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PCBMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../adminlte/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p class="d-block text-white">{{auth()->user()->name}} </p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/suppliers" class="nav-link {{ request()->is('suppliers*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-truck"></i>
              <p>
                Suppliers
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/products" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Products
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('employees*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employees
                <i class="fas fa-angle-right right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/add_employee" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/employees" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List All Employees</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/sales" class="nav-link {{ request()->is('sales*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('logs*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-clock"></i>
              <p>
                Logs
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/logs" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Activity Logs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dtr" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Time Record</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    {{ $slot }}
  </div>
  {{-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> --}}

  <!-- Control Sidebar -->
  {{-- <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside> --}}
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/js/adminlte.min.js"></script>
{{-- <!-- AdminLTE for demo purposes -->
<script src="../../adminlte/js/demo.js"></script> --}}
</body>
</html>
