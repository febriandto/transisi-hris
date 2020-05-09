<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Syncrum Warehouse | V.001 Alpha</title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="csrf-token" content="{{ csrf_token() }}">



  <link rel="icon" href="{{ asset('images/icon.png') }}">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- Ionicons -->

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- overlayScrollbars -->

  <link rel="stylesheet" href="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- Theme style -->

  <link rel="stylesheet" href="{{ asset('sys/vendor/almasaeed2010/adminlte/dist/css/adminlte.css') }}">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

  <!-- Google Font: Source Sans Pro -->

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

  @toastr_css

</head>

<!-- custom css -->

<style type="text/css">
  @media (min-width: 992px) {

    .sidebar-mini.sidebar-collapse .main-sidebar,
    .sidebar-mini.sidebar-collapse .main-sidebar::before {

      margin-left: 0;

      width: 4.2rem;

    }

  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- Site wrapper -->

  <div class="wrapper">

    <!-- Navbar -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Left navbar links -->

      <ul class="navbar-nav">

        <li class="nav-item">

          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>

        </li>
        
      </ul>

      <!-- Right navbar links -->

    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->

      <li class="nav-item dropdown">

        <a class="nav-link" data-toggle="dropdown" href="#">

          <i class="fas fa-ellipsis-h"></i>

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <a href="{{ route('profile.index') }}" class="dropdown-item">

            <i class="fas fa-user mr-2"></i> Profile 

          <span class="float-right text-muted text-sm">{{ Auth::user()->name }}</span>

          </a>

          <a href="{{ route('logout') }}" class="dropdown-item">

            <i class="fas fa-sign-out-alt mr-2"></i> Logout

            <span class="float-right text-muted text-sm">Logout Your Account</span>

          </a>

        </div>

      </li>

    </ul>

  </nav>

  <!-- /.navbar -->



  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->

    <a href="#" class="brand-link text-center" style="background: white;">

      <img src="{{ asset('images/logo_syncrum_header.png') }}" alt="Syncrum Logo" style="float: none;" class="brand-image">

    </a>



    <!-- Sidebar -->

    <div class="sidebar" style="overflow-y: hidden;padding: 0 !important;background:#222d32;">

      <!-- Sidebar user (optional) -->

      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="image">

          <img src="{{ asset('sys/vendor/almasaeed2010/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">

        </div>

        <div class="info">

          <a href="#" class="d-block">{{ Auth::user()->name }}</a>

        </div>

      </div> -->



      <!-- Sidebar Menu -->

      <nav class="mt-2">



        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



          <li class="nav-item">

            <a href="{{ route('beranda.dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">

              <i class="nav-icon fas fa-tachometer-alt"></i>

              <p>DASHBOARD </p>

            </a>

          </li>

          <li class="nav-header">INBOUND </li>
          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-clipboard-check nav-icon"></i>
              <p>Tally<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Tally Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Create Tally</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Upload Tally</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-dolly nav-icon"></i>
              <p>Put Away<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Do PutAway</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Monitoring</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-file nav-icon"></i>
              <p>Report<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format A</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format B</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format C</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-header">INVENTORY</li>
          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-clipboard-list nav-icon"></i>
              <p>Inventory Transaction<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Inventory Transfer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Stock Take</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Repack</p>
                </a>
              </li>


            </ul>
          </li>




          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-file nav-icon"></i>
              <p>Report<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format A</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format B</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format C</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-header">OUTBOUND</li>
          <!-- <li class="nav-item">
            <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-clipboard-check nav-icon"></i>
              <p>Picking<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Picking Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Create Picking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Upload Picking</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-dolly nav-icon"></i>
              <p>Loading<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Do Loading</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Monitoring</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-file nav-icon"></i>
              <p>Report<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format A</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format B</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Format C</p>
                </a>
              </li>
            </ul>
          </li>



          <li class="nav-header" id="master-data">MASTER DATA</li>
          <li class="nav-item">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-pallet nav-icon"></i>
              <p>Item Master<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Item Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Item Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Item Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>UOM (Unit of Measure)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>UOM Conversion</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item
          {{ request()->is('customer/master') ? 'menu-open' : '' }}
          ">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-user nav-icon"></i>
              <p>Customer<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customermaster.index') }}" class="nav-link {{ request()->is('customer/master') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Customer Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>User Customer</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- menuopen effect --}}
          <li class="nav-item 
            {{ request()->is('warehouse/name') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/zone') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/area') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/row') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/bin') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/plant') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/location') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/pallet') ? 'menu-open' : '' }}
          ">
            <a href="../../index2.html" class="nav-link">
              <i class="fas fa-warehouse nav-icon"></i>
              <p>Warehouse Master<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('warehouseplant.index') }}" class="nav-link {{ request()->is('warehouse/plant') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Plant</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('warehouse.index') }}" class="nav-link {{ request()->is('warehouse/name') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousezone.index') }}" class="nav-link {{ request()->is('warehouse/zone') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Zone</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousearea.index') }}" class="nav-link {{ request()->is('warehouse/area') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouserow.index') }}" class="nav-link {{ request()->is('warehouse/row') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Row</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousebin.index') }}" class="nav-link {{ request()->is('warehouse/bin') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Bin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouselocation.index') }}" class="nav-link {{ request()->is('warehouse/location') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Location</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pallet.index') }}" class="nav-link {{ request()->is('warehouse/pallet') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Pallet ID</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-header">SETTING</li>
          <li class="nav-item">
            <a href="{{ route('warehousezone.index') }}" class="nav-link {{ request()->is('/warehousezone') ? 'active' : '' }}">
              <i class="fas fa-cog nav-icon"></i>
              <p>Setting</p>
            </a>
          </li>

        </ul>

      </nav>


      <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

  </aside>



  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>@yield('title')</h1>

          </div>

          <div class="col-sm-6">

            @yield('breadcrumb')

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->

    <section class="content">



      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            @yield('content')

          </div>

        </div>

      </div>

    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->



  <footer class="main-footer">

    <div class="float-right d-none d-sm-block">

      <b>Version</b> V.001 Alpha

    </div>

    <small>Copyright &copy; {{date("Y")}} PT. SYNCRUM LOGISTICS 2020.</small>

  </footer>



  <!-- Control Sidebar -->

  <aside class="control-sidebar control-sidebar-dark">

    <!-- Control sidebar content goes here -->

  </aside>

  <!-- /.control-sidebar -->

  </div>

  <!-- ./wrapper -->



  <!-- jQuery -->

  <script src="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap 4 -->

  <script src="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- overlayScrollbars -->

  <script src="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

  <!-- AdminLTE App -->

  <script src="{{ asset('sys/vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js') }}"></script>



  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>

  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>

  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  
  @toastr_js
  @toastr_render



  <script type="text/javascript">
    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });
  </script>



  @yield('script')



</body>

</html>