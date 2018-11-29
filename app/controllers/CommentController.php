<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$comment = new Comment;
		$userID = Auth::user()->id;
		$input = Input::all();
		
		$postID = $input['postID'];
		$post = Post::find($postID);
		$author = $post->getPostAuthor($post->id);
		
		// create validation object

		$v = Validator::make($input, Comment::$rules);
		
		if ($v->passes()) {
			
			$comment->message = $input['message'];
			$comment->user_id = $userID;
			$post->comments()->save($comment);
			$comments = $post->comments()->paginate(6);
			
			return View::make('comments.create_comment')->withPost($post)->withAuthor($author)->withComments($comments);
			
		} else {
			
			$comments = $post->comments()->paginate(6);
			return View::make('comments.create_comment')->withErrors($v)->withPost($post)->withAuthor($author)->withComments($comments);
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
		//
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
		
		$comment = Comment::find($id);
		$post = $comment->getPost($id);
		$author = $post->getPostAuthor($post->id);
		
		if ($userID == $comment['user_id']) {
			
			$comments = $post->getComments($post->id);
			return View::make('comments.edit_comment')->withAuthor($author)->withComment($comment)->withComments($comments)->withPost($post);
			
		} else {
			
			$comments = $post->getComments($post->id);
			return View::make('comments.create_comment')->withAuthor($author)->withComment($comment)->withComments($comments)->withPost($post);
			
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
		$comment = Comment::find($id);
		$post = $comment->getPost($id);
		
		
		$input = Input::all();
		$v = Validator::make($input, Comment::$rules);
		
		if ($v->passes()) {
		
			$comment->message = $input['message'];
			$comment->save();
			$comments = $post->getComments($post->id);
			$author = $post->getPostAuthor($post->id);
			
			return View::make('comments.create_comment')->withPost($post)->withComments($comments)->withAuthor($author);
		
		} else {
			
			$comments = $post->getComments($post->id);
			return View::make('comments.create_comment')->withPost($post)->withErros($v)->withComments($comments);;
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
		$comment = Comment::find($id);
		$post = $comment->getPost($id);
		$author = $post->getPostAuthor($post->id);
		
		$userID = Auth::user()->id;
		
		if ($userID == $comment['user_id']) {
			
			if (!is_null($post)) {
			
				$comment->delete();
				$comments = Comment::all()->sortByDesc('create_at');
				return View::make('comments.create_comment')->withPost($post)->withComments($comments)->withAuthor($author);
			}
		
		} else {
			
			$comments = $post->getComments($post->id);
			return View::make('comments.create_comment')->withPost($post)->withComments($comments)->withAuthor($author);
		}
		
	}


}
