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
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-user"></i>{{ $user->fullname }}<span></span></li>
					<li><i class="glyphicon glyphicon-fire"></i>{{ $user->getUserAge($user->dob) }} <span></span></li>
					<li><i class="glyphicon glyphicon-envelope"></i>{{ $user->username }}<span></span></li>
					@if (Auth::check() && Auth::user()->isFriendWith($user->id) == false)
					<li><i class="glyphicon glyphicon-plus"></i>{{ link_to_route('add.friend', 'Add friend', array('id' => $user->id)) }}</li>
					@elseif (Auth::check() && Auth::user()->isFriendWith($user->id) == true)
					<li><i class="glyphicon glyphicon-minus"></i>{{ link_to_action('UserController@getFriendRemove', 'Remove friend', array('id' => $user->id)) }}</li>
					@else
					
					@endif
				</ul>
			</div>
		</article>
        <div class="text-center">
            
        </div>
	</section>
	 

    <h2>Posts</h2>
    
    
    @foreach ($posts as $post)
    <div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="http://placekitten.com/150/150">
  		</a>
  		<div class="media-body">
  		    
    		<h4 class="media-heading">{{ $post->title }}</h4>
          <p class="text-right">{{ $post->getPostAuthor($post->id) }}</p>
          <p>{{ $post->message }}</p>
          <ul class="list-inline list-unstyled">
  			<li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->getNumberOfDaysAndHours($post->created_at) }}</span></li>
            <li>|</li>
            <span><i class="glyphicon glyphicon-comment"></i>  {{ link_to_route('post.show', $comments = $post->getNumberOfComments($post->id).' comment(s)' , array($post->id)) }}  </span>
            <li>|</li>
            <span><i class="glyphicon glyphicon-filter"></i>  <b>{{ $post->privacy }}</b>  </span>
			</ul>
       </div>
    </div>
  </div>
    @endforeach
</div>
@stop
