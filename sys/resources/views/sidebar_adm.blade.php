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

				<?php

					$parent = DB::select(" SELECT * FROM `wms_m_menu` a  
					LEFT JOIN wms_m_role_link b ON a.id_menu = b.id_menu
					WHERE b.id_role = ".Auth::user()->id_role." AND can_access = 1
					ORDER BY `menu_position` ASC ");

				?>
				
				@foreach( $parent as $parent )

					<!-- Link  -->
					@if( $parent->menu_type == "LINK" AND $parent->parent_id_1 == NULL )
					<li class="nav-item">
						<a href="{{ route($parent->link_menu) }}" class="nav-link {{ Route::is($parent->link_menu) ? 'active' : '' }}">
							<i class="nav-icon fas fa-{{ $parent->icon_menu }}"></i>
							<p>{{ $parent->nama_menu }} </p>
						</a>
					</li>
					@endif
					<!-- Link  -->

					<!-- Divider -->
					@if( $parent->menu_type == "DIVIDER" AND $parent->parent_id_1 == NULL )
					<li class="nav-header"> {{ $parent->nama_menu }} </li>
					@endif
					<!-- Divider -->

					<!-- Dropdown -->
					@if( $parent->menu_type == "DROPDOWN" AND $parent->parent_id_1 == NULL )
					<?php $p1 = App\Model\Menu::where('parent_id_1', $parent->id_menu)->pluck('link_menu')->toArray(); ?>
					<li class="nav-item {{ in_array(\Request::route()->getName(), $p1) ? 'menu-open' : '' }}">

						<a href="#" class="nav-link {{ Route::is($parent->link_menu) ? 'active' : '' }}">
							<i class="fas fa fa-{{ $parent->icon_menu }} nav-icon"></i>
							<p>{{ $parent->nama_menu }}<i class="right fas fa-angle-left"></i></p>
						</a>

						<ul class="nav nav-treeview">

						<!-- Link Dropdown -->
						<?php
							$child = DB::select(" SELECT * FROM `wms_m_menu` a  
							LEFT JOIN wms_m_role_link b ON a.id_menu = b.id_menu
							WHERE b.id_role = ".Auth::user()->id_role." AND can_access = 1 AND parent_id_1 = ".$parent->id_menu."
							ORDER BY `menu_position` ASC ");
						?>

						@foreach( $child as $child )
							@if( $child->menu_type == "LINK" )
							<li class="nav-item">
								<a href="{{ route($child->link_menu) }}" class="nav-link {{ Route::is($child->link_menu) ? 'active' : '' }}">
									<i class="fas fa-{{ $child->icon_menu }} nav-icon"></i>
									<p>{{ @$child->nama_menu }}</p>
								</a>
							</li>
							@endif

							<!-- Dropdown in Dropdown -->
							@if( $child->menu_type == "DROPDOWN" )

							<li class="nav-item">
								
								<a href="#" class="nav-link">
										<i class="fas fa-{{ $child->icon_menu }} nav-icon"></i>
										<p>{{ $child->nama_menu }}<i class="right fas fa-angle-left"></i></p>
								</a>
							
							<ul class="nav nav-treeview" style="padding-left: 10px;">
							<?php
								$child2 = DB::select(" SELECT * FROM `wms_m_menu` a  
								LEFT JOIN wms_m_role_link b ON a.id_menu = b.id_menu
								WHERE b.id_role = ".Auth::user()->id_role." AND can_access = 1 AND parent_id_1 = ".$child->id_menu."
								ORDER BY `menu_position` ASC ");
							?>

								@foreach( $child2 as $child2 )
									<li class="nav-item">
										<a href="{{route($child2->link_menu)}}" class="nav-link">
											<i class="fas fa-angle-right nav-icon"></i>
											<p>{{ $child2->nama_menu }}</p>
										</a>
									</li>
									@endforeach

								</ul>
							</li>

							@endif

						@endforeach
						<!-- Link Dropdown -->
						

						</ul>
					</li>
					<!-- Dropdown -->

					@endif
				@endforeach

			</nav>



			<!-- /.sidebar-menu -->

		</div>

		<!-- /.sidebar -->

	</aside>