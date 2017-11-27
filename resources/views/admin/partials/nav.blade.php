<header>
	<nav class="navbar navbar-default" style="margin: 0px;">
		<div class="container">
			<div class="navbar-header">
				<a href="{{ route('welcome.index') }}" class="navbar-brand main-title">Tienda</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ route('categories.index') }}">Categorías</a></li>
					<li><a href="{{ route('products.index') }}">Productos</a></li>
					<li><a href="{{ route('admin.orders.index') }}">Pedidos</a></li>
					<li><a href="{{ route('users.index') }}">Usuarios</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user"> {{ Auth::user()->name }}</i>
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{ route('logout') }}"
									 onclick="event.preventDefault();
																									 document.getElementById('logout-form').submit();">
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
							<li><a href="{{ route('welcome.index') }}">Ir a la tienda</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</header>
