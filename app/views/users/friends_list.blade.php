@extends('layouts.master')


@section ('title')

Friends List

@stop

@section('extra')
</br>
</br>
</br>
</br>
</br>
</br>

<h2>Friends List</h2>
	 @foreach ($friends as $friend)
	<section class="col-xs-12 col-sm-6 col-md-12">
    
		<article class="search-result row">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<a href="#" title="Lorem ipsum" class="thumbnail"><img src="http://lorempixel.com/250/140/cats" alt="Lorem ipsum" /></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-user"></i>{{ link_to_route('user.show', $friend->fullname , array($friend->id)) }}<span></span></li>
					<li><i class="glyphicon glyphicon-fire"></i>{{ $friend->getUserAge($friend->dob) }} <span></span></li>
					<li><i class="glyphicon glyphicon-envelope"></i>{{ $user->username }}<span></span></li>
					<li><i class="glyphicon glyphicon-minus"></i>{{ link_to_action('UserController@getFriendRemove', 'Remove friend', array('id' => $friend->id)) }} <span></span></li>
				</ul>
			</div>
		</article>
		</section>
	@endforeach

@stop