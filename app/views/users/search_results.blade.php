@extends('layouts.master')

@section('title')

Search Results

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
        <h2>Search Results</h2>
		<h2 class="lead"><strong class="text-danger">{{ $number }}</strong> results were found for the search for <strong class="text-danger">{{ $search }}</strong></h2>								
	</hgroup>
	@foreach ($users as $user)
    <section class="col-xs-12 col-sm-6 col-md-12">
    
		<article class="search-result row">
			<div class="col-xs-12 col-sm-12 col-md-3">
				<a href="#" title="Lorem ipsum" class="thumbnail"><img src="http://lorempixel.com/250/140/cats" alt="Lorem ipsum" /></a>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-2">
				<ul class="meta-search">
					<li><i class="glyphicon glyphicon-user"></i>{{ link_to_route('user.show', $user->fullname , array($user->id)) }} <span></span></li>
					<li><i class="glyphicon glyphicon-fire"></i>{{ $user->getUserAge($user->dob) }} <span></span></li>
				</ul>
			</div>
		</article>
		</section>
	@endforeach
        <div class="text-center">
            
        </div>
	
</div>

@stop