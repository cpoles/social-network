<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title')</title>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  </head>

  <body>
<div class ="container">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">{{ link_to_route('post.index', 'Social Network') }}</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a class="navbar-brand">{{ HTML::link('requirements', 'Requirements') }}</a></li>
					<li><a class="navbar-brand">{{ HTML::link('erdiagram', 'ER DIAGRAM') }}</a></li>
					<li><a class="navbar-brand">{{ HTML::link('sitediagram', 'SITE DIAGRAM') }}</a></li>
					@if (Auth::check())
					{{-- if logged in, show links for friends list and user profile and hide login and sign up --}}
				 	<li><a class="navbar-brand">{{ link_to_route('list.friend', 'Friends List', array('id' => Auth::user()->id)) }}</a></li>
			  		<li><a class="navbar-brand">{{ link_to_route('show.profile', 'User Profile', array('id' => Auth::user()->id)) }}</a></li>
			  		@else
			  		{{-- show sign up and log in only --}}
					<li><a class="navbar-brand">{{ link_to_route('user.create', 'Sign Up') }}</a></li>
					<li><a class="navbar-brand">{{ link_to_route('login.page', 'Log In') }}</a></li>
					@endif
				</ul>
				{{ Form::open(array('action' => 'UserController@search', 'class' => 'navbar-form', 'role' => 'search')) }}
				<form class="navbar-form" role="search">
					<div class="input-group">
					
				{{ Form::text('search','', array('class' => 'form-control pull-right', 'style' => 'width: 300px; margin-right: 35px, border: 1px solid black; background-color: #e5e5e5;', 'placeholder' => 'Search')) }}
						<span class="input-group-btn">
							<button type="reset" class="btn btn-default">
								<span class="glyphicon glyphicon-remove">
									<span class="sr-only">Close</span>
								</span>
							</button>
				{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
						</span>
					</div>
				{{ Form::close() }}
				<div class = "text-center">
					<b style="color:red">{{{ $errors->first('search') }}}</b>
				</div>

				@if (Auth::check())
			<b>Welcome back, {{ Auth::user()->fullname }}! {{ link_to_route('user.logout', 'Sign out') }}</b>	 
			  @endif
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class='row'>
	    @yield('extra')
	</div>
	
</div>
 
  


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

