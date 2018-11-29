<?php

class PostController extends \BaseController {

	/**
	 * Display all public posts when a user is not logged inf
	 *
	 * @return Response
	 */
	public function index()
	{
		// return only public posts
		$posts = Post::whereRaw('privacy like ?', array("public"))->orderBy('created_at', 'desc')->paginate(5);
		
		// check whether user is logged in. If not, show only public posts.
		
		if (!Auth::check()) {
			
			return View::make('posts.posts')->withPosts($posts);
			
		} else {
			
			$user = Auth::user();
			$name = $user->fullname;
			$userID = $user->id;
			
			$friends = $user->friends;
			$postsUser = $user->posts;
			
		
			return View::make('posts.create')->withPosts($posts)->withUser($user);

		}
	}
	

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if (!Auth::check()) return Redirect::route('post.index');
		
		$posts = Post::whereRaw('privacy like ?', array("public"))->orderBy('created_at', 'desc')->paginate(5);
		
		return View::make('posts.create')->withPosts($posts);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// get logged user id
		$userID = Auth::user()->id;
		
		// get inputs
		$input = Input::all();
		
		// Validation
		
		$v = Validator::make($input, Post::$rules);
		
		if ($v->passes()) {
		
			$post = new Post();
			$post->title = $input['title'];
			$post->message = $input['message'];
			$post->privacy = $input['privacy'];
			$post->user_id = $userID;
			$post->save();
			
			return Redirect::action('PostController@create');
		
		} else {
			
			$posts = Post::whereRaw('privacy like ?', array("public"))->orderBy('created_at', 'desc')->paginate(5);
			return View::make('posts.create')->withErrors($v)->withPosts($posts);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	
		// if not logged in, do not allow comments
		if (!Auth::check()) {
		
			$post = Post::find($id);
			$author = $post->getPostAuthor($post->id);
			$comments = $post->comments()->orderBy('created_at', 'desc')->paginate(6);
			$date = $post->getNumberOfDaysAndHours($post->created_at);
			return View::make('posts.post_detail')->withPost($post)->withAuthor($author)->withComments($comments)->withTime($date);
		} else {
			
			$post = Post::find($id);
			$author = $post->getPostAuthor($post->id);
			$comments = $post->comments()->orderBy('created_at', 'desc')->paginate(6);
			$date = $post->getNumberOfDaysAndHours($post->created_at);
			$posts = Post::orderBy('created_at', 'desc')->paginate(5);
			return View::make('comments.create_comment')->withPost($post)->withAuthor($author)->withComments($comments)->withTime($date)->withPosts($posts);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$userID = Auth::user()->id;
		
		$post = Post::find($id);
		$posts = Post::whereRaw('privacy like ?', array("public"))->orderBy('created_at', 'desc')->paginate(5);
		
		if ($userID == $post->user_id) {
		
			return View::make('posts.edit')->withPost($post)->withPosts($posts);
		
		} else {
			

			return View::make('posts.create')->withPost($post)->withPosts($posts);
		}
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$post = Post::find($id);
		$posts = Post::orderBy('created_at', 'desc')->paginate(5);
		$input = Input::all();
		$v = Validator::make($input, Post::$rules);
		
		if ($v->passes()) {
		
			$post->title = $input['title'];
			$post->message = $input['message'];
			$post->save();
			
			return Redirect::route('post.show', $post->id);
		
		} else {
			
			return View::make('posts.edit')->withPost($post)->withPosts($posts)->withErros($v);
		}
		
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		
		$userID = Auth::user()->id;
		
		$post = Post::find($id);
		
		if ($userID == $post['user_id']) {
			
			if (!is_null($post)) {
			
				$post->comments()->delete();
				$post->delete();
				$posts = Post::orderBy('created_at', 'desc')->paginate(5);
				return View::make('posts.create')->withPost($post)->withPosts($posts);
			}
		
		} else {
			
			$posts = Post::orderBy('created_at', 'desc')->paginate(5);
			return View::make('posts.create')->withPost($post)->withPosts($posts);
		}
		
	}


}
