<header class="app-header">
	<a class="app-header__logo" href="{{ url('/') }}">{{ config('app.name', 'Membership') }}</a>
	<!-- Sidebar toggle button-->
	<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar">
		<i class="fas fa-menu"></i>
	</a>
	<!-- Navbar Right Menu-->
	<ul class="app-nav">
		<!-- User Menu-->
		<li class="dropdown">
			<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
				<i class="fa fa-cog fa-lg"></i> <span class="pl-2">Setting</span>
			</a>
			<ul class="dropdown-menu settings-menu dropdown-menu-right">
				<li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt fa-lg"></i> Logout</a></li>
			</ul>
		</li>
	</ul>
</header>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="app-sidebar__user">
	<img class="app-sidebar__user-avatar img-fluid" style="width: 48px!important" src="{!! asset('images/logo.png') !!}" alt="User Image">
		<div>
			<p class="app-sidebar__user-name">{!! Auth::user()->identity->full_name !!}</p>
			<p class="app-sidebar__user-designation">{{ Auth::user()->currentRole() }}</p>
		</div>
	</div>
	<ul class="app-menu">
		<li>
			<a class="app-menu__item" href="{{ url('/') }}">
				<i class="app-menu__icon fas fa-tachometer-alt"></i><span class="app-menu__label">Dashboard</span>
			</a>
		</li>

		@if (Auth::user()->isAdmin())
			<li><a class="app-menu__item" href="{{ route('admin.users') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">User</span></a></li>
			<li><a class="app-menu__item" href="{{ route('admin.members') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Member</span></a></li>
			<li><a class="app-menu__item" href="{{ route('admin.transactions') }}"><i class="app-menu__icon fas fa-exchange-alt"></i><span class="app-menu__label">Transaksi</span></a></li>
		@endif
		
		@if (Auth::user()->hasRole('member'))
			<li><a class="app-menu__item" href="{{ route('member.profile') }}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Profile</span></a></li>
			@if (Auth::user()->isVerified())
				<li><a class="app-menu__item" href="{{ route('member.transaction') }}"><i class="app-menu__icon fas fa-exchange-alt"></i><span class="app-menu__label">Transaksi Terakhir</span></a></li>
			@endif
		@endif
		
	</ul>
</aside>