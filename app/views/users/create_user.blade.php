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

    <title>Sign Up</title>

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
					<li><a href="#">ERD</a></li>
					<li><a href="#">Link</a></li>
				</ul>

				<form class="navbar-form" role="search">
					<div class="input-group">
						<input type="text" class="form-control pull-right" style="width: 300px; margin-right: 35px, border: 1px solid black; background-color: #e5e5e5;" placeholder="Search">
						<span class="input-group-btn">
							<button type="reset" class="btn btn-default">
								<span class="glyphicon glyphicon-remove">
									<span class="sr-only">Close</span>
								</span>
							</button>
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search">
									<span class="sr-only">Search</span>
								</span>
							</button>
						</span>
					</div>
				</form>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>

<div class="container">
		</br>
		</br>
		</br>
		</br>
		</br>
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Please sign up for Social Network <small>It's free!</small></h3>
			 			</div>
			 			<div class="panel-body">
			    		
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					{{ Form::open(array('action' => 'UserController@store', 'files' => 'true', 'class' => 'form-horizontal', 'role' => 'form')) }}
			    					<div class="form-group">
				                    {{ Form::text('fullname', '', array('class' => 'form-control input-sm', 'placeholder'=> 'Full Name')) }} 
			    					</div>
			    					<b style="color:red">{{{ $errors->first('fullname') }}}</b>
			    				</div>
			    			</div>
			    			<div class="form-group">
			    				{{ Form::email('username', '', array('class' => 'form-control input-sm', 'placeholder'=> 'Email address - This will be your username.')) }}
			    			</div>
			    				<b style="color:red">{{{ $errors->first('username') }}}</b>
							<div class="form-group">
			    				{{ Form::text('dob', '', array('class' => 'form-control input-sm', 'placeholder'=> 'Date Of Birth')) }}
			    			</div>
			    			<b style="color:red">{{{ $errors->first('dob') }}}</b>
			    			<div class="form-group">
			    				{{-- Form::file('image') --}}
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					{{ Form::password('password', array('class' => 'form-control input-sm', 'placeholder'=> 'Password')) }}	
			    					</div>
			    					<b style="color:red">{{{ $errors->first('password') }}}</b>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					{{ Form::password('password_confirmation', array('class' => 'form-control input-sm', 'placeholder'=> 'Confirm Password')) }}
			    					</div>
			    					<b style="color:red">{{{ $errors->first('password_confirmation') }}}</b>
			    				</div>
			    			</div>
			    			{{ Form::submit('Register', array('class' => 'btn btn-info btn-block')) }}
			    		{{ Form::close() }}
			    	
			    	</div>
	    		</div>
    		</div>
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