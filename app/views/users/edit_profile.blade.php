@extends('layouts.master')

@section('title')

User Profile

@stop

@section('extra')

</br>
</br>
</br>
</br>
</br>
</br>
<div class="container">
    <hgroup class="mb20">
        <h2>Profile</h2>
	</hgroup>
    <section class="col-xs-12 col-sm-6 col-md-12">
        
		<article class="search-result row">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<a href="#" title="Lorem ipsum" class="thumbnail"><img src="http://lorempixel.com/250/140/cats" alt="Lorem ipsum" /></a>
			</div>
			{{ Form::model($user, array('method' => 'PUT', 'route'=> array('user.update', $user->id))) }} 
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-user"></i>{{ Form::text('fullname', $user->fullname , array('class' => 'form-control input-md', 'placeholder' => 'enter fullname')) }}<span></span></li>
					<b style="color:red">{{{ $errors->first('fullname') }}}</b>
					<li><i class="glyphicon glyphicon-fire"></i>{{ Form::text('dob', $user->dob , array('class' => 'form-control input-md', 'placeholder' => 'enter d.o.b')) }}<span></span></li>
					<b style="color:red">{{{ $errors->first('dob') }}}
				</ul>
			</div>
		</article>
		{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        {{ link_to_route('user.show', 'Back', array('class' => 'btn btn-inverse')) }}
        <div class="text-center">
            
        </div>
	</section>
</div>
@stop
