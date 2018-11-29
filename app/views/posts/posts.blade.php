@extends('layouts.master')

@section('title')

Posts

@stop

@section('extra')
</br>
</br>
</br>
</br>
</br>
@foreach($posts as $post)
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
	<div class="text-center">
	  {{ $posts->links() }}
	</div>
	
	
@stop