@extends('layouts.master')

@section('title')

Login to Social Network

@stop
</br>
</br>
</br>
<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		{{ Form::open(array('url' => secure_url('user/login'), 'class' => 'form-horizontal', 'role' => 'form')) }}
			<fieldset>
				<h2>Please Sign In</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    {{ Form::email('username', '', array('class' => 'form-control input-lg', 'placeholder'=> 'Email address')) }}
				</div>
				<div class="form-group">
                   {{ Form::password('password', array('class' => 'form-control input-lg', 'placeholder'=> 'Password')) }}
                   <b style="color:red">{{ $errors->first('failed') }}</b>
				</div>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                       {{ Form::submit('Sign In', array('class' => 'btn btn-info btn-block')) }}
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
					    
						<a href="" class="btn btn-lg btn-primary btn-block">Register</a>
					</div>
				</div>
			</fieldset>
	    {{ Form::close() }}
	</div>
</div>

