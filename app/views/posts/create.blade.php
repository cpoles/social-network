@extends('layouts.master')

@section('title')

Posts

@stop

@section('extra')
    <div class="col-md-4">
        </br>
        </br>
        </br>
        </br>
        {{ Form::open(array('action' => 'PostController@store', 'class' => 'form-horizontal')) }} 
        <fieldset>
        
        <!-- Form Name -->
        <legend>Create Post</legend>
        
        <!-- Text input-->
        <div class="form-group">
              
          <label class="col-md-4 control-label" for="textinput">Title</label>  
          <div class="col-md-8">
            {{ Form::text('title', '', array('class' => 'form-control input-md', 'placeholder' => 'enter title')) }}
            <b style="color:red">{{{ $errors->first('title') }}}</b>
          </div>
        </div>
        
        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="textarea">Message</label>
          <div class="col-md-8">                     
            {{ Form::textarea('message', '', array('class' => 'form-control input-md', 'placeholder' => 'enter message')) }}
            <b style="color:red">{{{ $errors->first('message') }}}</b>
          </div>
        </div>
        
        <!-- Multiple Radios (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="privacy">Privacy</label>
          <div class="col-md-4"> 
            <label class="radio-inline" for="privacy-0">
            {{ Form::radio('privacy', 'public', 'checked') }} public
            </label> 
            <label class="radio-inline" for="privacy-1">
             {{ Form::radio('privacy', 'friends') }} friends
            </label>
            <label class="radio-inline" for="privacy-2">
             {{ Form::radio('privacy', 'private') }} private
            </label>
          </div>
        </div>
        
        <!-- Button (Double) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="btnPublish"></label>
          <div class="col-md-8">
            {{ Form::submit('Publish', array('class' => 'btn btn-primary')) }}
             {{ Form::reset('Cancel', array('class' => 'btn btn-inverse')) }}
             
          </div>
        </div>
        
        </fieldset>
        {{ Form::close() }}
        
                </div>
                <div class="col-md-8">
                    <!-- Page Content -->
                </br>
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
            		
                  <p class="text-right">{{ $author = $post->getPostAuthor($post->id) }}</p>
                  <p>{{ $post->message }}</p>
                  <ul class="list-inline list-unstyled">
          			<li><span><i class="glyphicon glyphicon-calendar"></i> {{ $post->getNumberOfDaysAndHours($post->created_at) }}</span></li>
                  <li>|</li>
                 <li> <span><i class="glyphicon glyphicon-comment"></i> {{ link_to_route('post.show', $comments = $post->getNumberOfComments($post->id).' comment(s)' , array($post->id)) }}</span></li>
                  <li>|</li>
                 <li> <span><i class="glyphicon glyphicon-edit"></i>{{ link_to_route('post.edit', 'Edit Post' , array($post->id)) }}</span></li>
                  <li>|</li>
                  <li> <span><i class="glyphicon glyphicon-filter"></i>  <b>{{ $post->privacy }}</b>  </span></li>
                     {{ Form::open(array('method' => 'DELETE', 'route' => array('post.destroy', $post->id))) }}
                  <li>  <span> {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}</span></li>
                    {{ Form::close() }}
                    
                    <!-- Use Font Awesome http://fortawesome.github.io/Font-Awesome/ -->
                      <span><i class="fa fa-facebook-square"></i></span>
                      <span><i class="fa fa-twitter-square"></i></span>
                      <span><i class="fa fa-google-plus-square"></i></span>
                    </li>
        			</ul>
               </div>
            </div>
          </div>
	@endforeach
	  <div class="text-center">
	  {{ $posts->links() }}
	  </div>
	  
@stop

