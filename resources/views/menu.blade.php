<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	        </button>
	    	<a class="navbar-brand" href="/">Автосервисы</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="{{ route('map.index') }}" title="Автосервисы в Одинцово на карте">Автосервисы на карте</a></li>
			</ul>

			<!-- <ul class="nav navbar-nav">
				<li class="active"><a href="#">Ссылка</a></li>
				<li><a href="#">Ссылка</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Действие</a></li>
						<li><a href="#">Другое действие</a></li>
						<li><a href="#">Что-то еще</a></li>
						<li class="divider"></li>
						<li><a href="#">Отдельная ссылка</a></li>
						<li class="divider"></li>
						<li><a href="#">Еще одна отдельная ссылка</a></li>
					</ul>
				</li>
			</ul> -->
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Отправить</button>
			</form>
			<!--<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Ссылка</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Действие</a></li>
						<li><a href="#">Другое действие</a></li>
						<li><a href="#">Что-то еще</a></li>
						<li class="divider"></li>
						<li><a href="#">Отдельная ссылка</a></li>
					</ul>
				</li>
			</ul>-->
	    </div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<!-- <div class="menu-top">
	<ul>
		<li><a href="/">Главная</a></li>
		<li><a href="{{ route('map.index') }}" title="Автосервисы в Одинцово на карте">Автосервисы на карте</a></li>
	</ul>
</div> -->