<aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x: hidden;">

		<!-- Brand Logo -->
		<a href="#" class="brand-link text-center" style="background: white;">
			<img src="{{ asset('images/logo_syncrum_header_.png') }}" alt="Syncrum Logo" style="float: none;" class="brand-image">
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

					<li class="nav-header"></li>

					<li class="nav-item">
						<a href="{{route('stock_item_history.index')}}" class="nav-link
							{{ request()->is('stock_item_history')  ? 'active' : '' }}
							{{ request()->is('stock_item_history/*')? 'active' : '' }}
						">
							<i class="fas fa-box-open nav-icon"></i>
							<p>Stock Summary</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{route('stock.all')}}" class="nav-link
							{{ request()->is('stock')  ? 'active' : '' }}
							{{ request()->is('stock/*')? 'active' : '' }}
						">
							<i class="fas fa-box-open nav-icon"></i>
							<p>Stock Review</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{route('inbound_history.index')}}" class="nav-link
							{{ request()->is('inbound_history')  ? 'active' : '' }}
							{{ request()->is('inbound_history/*')? 'active' : '' }}">
							<i class="fas fa-angle-right nav-icon"></i>
							<p>Inbound History</p>
						</a>
					</li>
					
					<li class="nav-item">
						<a href="{{route('outbound_history.index')}}" class="nav-link
							{{ request()->is('outbound_history')  ? 'active' : '' }}
							{{ request()->is('outbound_history/*')? 'active' : '' }}">
							<i class="fas fa-angle-right nav-icon"></i>
							<p>Outbound History</p>
						</a>
					</li>

					<li class="nav-item">
						<a href="{{route('stock_item_detail.index')}}" class="nav-link
							{{ request()->is('stock_item_detail')  ? 'active' : '' }}
							{{ request()->is('stock_item_detail/*')? 'active' : '' }}">
							<i class="fas fa-sign-in-alt nav-icon"></i>
							<p>Stock Item Detail</p>
						</a>
					</li>

				</ul>
				<br><br><br>
			</nav>

			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>


	@section('script')
	<script>
		$('body').addClass('sidebar-collapse');
	</script>
	@stop