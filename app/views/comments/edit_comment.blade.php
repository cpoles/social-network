@extends('layouts.master')

@section('title')

Create Comment

@stop

@section('extra')

<div class = "col-md-4">
    </br>
        </br>
        </br>
        </br>
        {{ Form::model($comment, array('method' => 'PUT', 'route'=> array('comment.update', $comment->id))) }}
        {{ Form::hidden('commentID', $comment->id) }}
        <fieldset>
        
        <!-- Form Name -->
        <legend>Edit Comment</legend>
        
        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textarea">Message</label>
          <div class="col-md-8">                     
            {{ Form::textarea('message', $comment->message , array('class' => 'form-control input-md', 'placeholder' => 'enter message')) }}
            <b style="color:red">{{{ $errors->first('message') }}}</b>
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="btnPublish"></label>
          <div class="col-md-8">
            {{ Form::submit('Comment', array('class' => 'btn btn-primary')) }}
             {{ Form::reset('Cancel', array('class' => 'btn btn-inverse')) }}
          </div>
        </div>
        
        </fieldset>
        {{ Form::close() }}
                </div>
    
    
    
    
</div>

<div class = "col-md-8">
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
            <li>|</li>
              <li>{{ link_to_route('post.edit', 'Edit Post' , array($post->id)) }} </li>  
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
                                    
                                  <h4 class="media-heading user_name">{{ $author }}</h4>
                                  {{ $comment->message }}
                                  
                                  <p><small>{{ link_to_route('comment.edit', 'Edit' , array($comment->id)) }} - <a href="">Delete</a></small></p>
                                </div>
                              </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@stop