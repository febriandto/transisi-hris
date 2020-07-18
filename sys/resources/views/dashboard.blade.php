<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Syncrum Warehouse | V.002 Alpha</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('images/icon.png') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.css') }}">
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
  <!-- Select2js -->
  <link rel="stylesheet" href="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/select2/css/select2.css') }}">

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

          {{ Auth::user()->level }}

        </a>

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="transform: translate3d(-65%, 0px, 0px) !important;">

        <a href="{{ route('profile.index') }}" class="dropdown-item">

            <i class="fas fa-user mr-2"></i> Profile 

          </a>

          <a href="{{ route('logout') }}" class="dropdown-item">

            <i class="fas fa-sign-out-alt mr-2"></i> Logout

          </a>

        </div>

      </li>

    </ul>

  </nav>

  <!-- /.navbar -->



  <!-- Main Sidebar Container -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x: hidden;">

    <!-- Brand Logo -->

    <a href="#" class="brand-link text-center" style="background: white;">

      <img src="{{ asset('images/logo_syncrum_header.png') }}" alt="Syncrum Logo" style="float: none;" class="brand-image">

    </a>



    <!-- Sidebar -->

    <div class="sidebar" style="overflow-y: hidden;padding: 0 !important;background:#222d32;">


      <!-- Sidebar Menu -->

      <nav class="mt-2">



        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



          <li class="nav-item">

            <a href="{{ route('beranda.dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">

              <i class="nav-icon fas fa-tachometer-alt"></i>

              <p>Dashboard </p>

            </a>

          </li>

          <li class="nav-header">INBOUND </li>
          <li class="nav-item 
          {{ request()->is('tally') ? 'menu-open' : '' }}
          {{ request()->is('tally/*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fas fa fa-industry nav-icon"></i>
              <p>Tally<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('tally.index') }}" class="nav-link {{ request()->is('tally') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Tally</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tally.add') }}" class="nav-link {{ request()->is('tally/add') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Tally</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item
            {{ request()->is('putaway') ? 'menu-open' : '' }}
            {{ request()->is('putaway/*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fas fa-dolly nav-icon"></i>
              <p>Put Away<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('putaway.index') }}" class="nav-link {{ request()->is('master/ad/barang') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Put Away Data</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">INVENTORY</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
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

          <li class="nav-header">OUTBOUND</li>

          <li class="nav-item
            {{ request()->is('picking') ? 'menu-open' : '' }}
            {{ request()->is('picking/*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fas fa-bookmark nav-icon"></i>
              <p>Picking<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('picking.index') }}" class="nav-link {{ request()->is('picking') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Picking Data</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('picking.add') }}" class="nav-link {{ request()->is('picking/add') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Create Picking</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item
            {{ request()->is('loading') ? 'menu-open' : '' }}
            {{ request()->is('loading/*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fa fa-cart-arrow-down nav-icon"></i>
              <p>Loading<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('loading.index') }}" class="nav-link {{ request()->is('loading') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Loading Data</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header" id="master-data">MASTER DATA</li>
          <li class="nav-item
            {{ request()->is('item') ? 'menu-open' : '' }}
            {{ request()->is('item/*') ? 'menu-open' : '' }}
            {{ request()->is('item/category') ? 'menu-open' : '' }}
            {{ request()->is('uom') ? 'menu-open' : '' }}
            {{ request()->is('item/category') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fas fa-server nav-icon"></i>
              <p>Item Master<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('itemmaster.index') }}" class="nav-link {{ request()->is('item') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Item Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('itemcategory.index') }}" class="nav-link 
                  {{ request()->is('item/category') ? 'active' : '' }}
                  {{ request()->is('item/category/*') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Item Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('uom.index') }}" class="nav-link {{ request()->is('uom') ? 'active' : '' }}">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>UOM (Unit)</p>
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
          {{ request()->is('customer/master/*') ? 'menu-open' : '' }}
          {{ request()->is('customer/address') ? 'menu-open' : '' }}
          {{ request()->is('customer/address/*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Customer<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('customermaster.index') }}" class="nav-link 
                  {{ request()->is('customer/master') ? 'active' : '' }}
                  {{ request()->is('customer/master') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Customer Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customeraddress.index') }}" class="nav-link 
                  {{ request()->is('customer/master/address') ? 'active' : '' }}
                  {{ request()->is('customer/master/address/*') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Customer Address</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- menuopen effect --}}
          <li class="nav-item 
            
            {{ request()->is('warehouse/name') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/name/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/name/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/plant') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/plant/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/plant/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/zone') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/zone/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/zone/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/area') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/area/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/area/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/row') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/row/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/row/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/bin') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/bin/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/bin/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/location') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/location/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/location/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/pallet') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/pallet/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/pallet/edit') ? 'menu-open' : '' }}

            {{ request()->is('warehouse/column') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/column/add') ? 'menu-open' : '' }}
            {{ request()->is('warehouse/column/edit') ? 'menu-open' : '' }}

          ">
            <a href="#" class="nav-link">
              <i class="fas fa-warehouse nav-icon"></i>
              <p>Warehouse Master<i class="right fas fa-angle-left"></i></p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('warehouseplant.index') }}" class="nav-link 
                  {{ request()->is('warehouse/plant') ? 'active' : '' }}
                  {{ request()->is('warehouse/plant/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/plant/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Plant</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ route('warehousename.index') }}" class="nav-link 
                  {{ request()->is('warehouse/name') ? 'active' : '' }}
                  {{ request()->is('warehouse/name/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/name/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousezone.index') }}" class="nav-link 
                  {{ request()->is('warehouse/zone') ? 'active' : '' }}
                  {{ request()->is('warehouse/zone/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/zone/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Zone</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousearea.index') }}" class="nav-link 
                  {{ request()->is('warehouse/area') ? 'active' : '' }}
                  {{ request()->is('warehouse/area/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/area/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehouserow.index') }}" class="nav-link 
                  {{ request()->is('warehouse/row') ? 'active' : '' }}
                  {{ request()->is('warehouse/row/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/row/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Row</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('warehousebin.index') }}" class="nav-link 
                  {{ request()->is('warehouse/bin') ? 'active' : '' }}
                  {{ request()->is('warehouse/bin/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/bin/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Bin</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('pallet.index') }}" class="nav-link 
                  {{ request()->is('warehouse/pallet') ? 'active' : '' }}
                  {{ request()->is('warehouse/pallet/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/pallet/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Pallet ID</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('level.index') }}" class="nav-link 
                  {{ request()->is('warehouse/level') ? 'active' : '' }}
                  {{ request()->is('warehouse/level/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/level/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Row Level ID</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('column.index') }}" class="nav-link 
                  {{ request()->is('warehouse/column') ? 'active' : '' }}
                  {{ request()->is('warehouse/column/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/column/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Row Column ID</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('location.index') }}" class="nav-link 
                  {{ request()->is('warehouse/location') ? 'active' : '' }}
                  {{ request()->is('warehouse/location/add') ? 'active' : '' }}
                  {{ request()->is('warehouse/location/edit') ? 'active' : '' }}
                ">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Warehouse Location</p>
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

            <h1 style="font-size: 16px;font-weight: 400;">@yield('title')</h1>

          </div>

          <div class="col-sm-6 text-right align-self-center">

            <span class="small">
              <a href="{{ route('beranda.dashboard') }}"> Beranda </a>
              <span class="text-muted mx-1"> > </span>
            </span>

            <span class="small">
              @yield('breadcrumb')
            </span>

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

  <!-- Select2js  -->
  <script src="{{ asset('sys/vendor/almasaeed2010/adminlte/plugins/select2/js/select2.min.js') }}"></script>

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

    $(document).ready( function () {

      // DataTables 
      $('#dataTables').DataTable({
        "pageLength": 25
      });

      // Select2
      $('.select2').select2({
        theme: "classic"
      });

    } );
  </script>



  @yield('script')



</body>

</html>