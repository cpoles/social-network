@extends('layouts.master')


@section('title')

Post Details

@stop

@section('extra')
</br>
</br>
</br>

<div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="http://placekitten.com/150/150">
  		</a>
  		<div class="media-body">
  		    
    		<h4 class="media-heading">{{ $post->title }}</h4>
          <p class="text-right">{{ $author }}</p>
          <p>{{ $post->message }} </p>
          <ul class="list-inline list-unstyled">
  			<li><span><i class="glyphicon glyphicon-calendar"></i>{{ $post->getNumberOfDaysAndHours($post->created_at) }} </span></li>
            <li>|</li>
            <span><i class="glyphicon glyphicon-filter"></i>  <b>{{ $post->privacy }}</b>  </span>
            <li></li>
            <li>|</li>
			</ul>
		
       </div>
    </div>
  </div>
<div class="container">
            <div class="row">
                <div class="col-md-8">
                  <div class="page-header">
                    <h3><small class="pull-right">{{ count($comments)  }}</small> Comments </h3>
                  </div> 
                  @foreach ($comments as $comment)
                   <div class="comments-list">
                       <div class="media">
                           <p class="pull-right"><small>{{ $comment->getTime($comment->created_at) }}</small></p>
                            <a class="media-left" href="#">
                              <img src="http://lorempixel.com/40/40/people/1/">
                            </a>
                            <div class="media-body">
                                
                              <h4 class="media-heading user_name">{{ $comment->getCommentAuthor($comment->id) }}</h4>
                              {{ $comment->message }}
                              
                              <p><small><a href=""></a> - <a href=""></a></small></p>
                            </div>
                          </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="text-center">
	      {{ $comments->links() }}
	      </div>
    </div>

@stop