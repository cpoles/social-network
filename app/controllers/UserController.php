<?php

class UserController extends \BaseController {
	
	/**
	 * Function for log in to the system
	 */
	public function login() 
	{
		$userdata = array (
				'username' => Input::get('username'),
				'password' => Input::get('password')
			);
			
		// authenticate
		
		if (Auth::attempt($userdata)) {
			return Redirect::route('post.index');
		} else {
			return Redirect::to(URL::previous())->withInput()->withErrors(['failed' => 'Invalid credentials. Please try again.']);
			
		}
		
	}
	
	/**
	 * Function for log out of the system
	 */
	public function logout()
	{
	
			Auth::logout();	
			return Redirect::route('post.index');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('users.login_page');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create_user');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
		// Validation
		
		$v = Validator::make($input, User::$rules);
		
		if ($v->passes()) {
			
			// store credentials
			$password = $input['password'];
			$encrypted = Hash::make($password);
			
			// create the new user object
			$user = new User;
			$user->username = $input['username'];
			$user->fullname = $input['fullname'];
		//	$user->image = Input::file('image');
			$dob = $input['dob'];
			// build date and time object
			$dtime = DateTime::createFromFormat('d/m/Y', $dob);
			$timestamp = $dtime->getTimestamp();
			$user->dob = $timestamp;
			$user->password = $encrypted;
			
			// save in the database
			$user->save();
			
			// get new id
			$userID = $user->id;
			
			return Redirect::action('PostController@index');
			
		} else {
			// if validation fails, return to the form displaying the errors.
			
			return Redirect::action('UserController@create')->withErrors($v);
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
		$user = User::find($id);
		
		if (!Auth::check()) {
			
		    $posts = $user->posts()->whereRaw('privacy like ?', array("public"))->get();
			return View::make('users.profile')->withUser($user)->withPosts($posts);
			
			
		} elseif (Auth::check() && Auth::user()->isFriendWith($user->id) == true) {
			
			
		    $posts = $user->posts;
		    //->whereRaw('privacy like ?', array("public"))->orwhereRaw('privacy like ?', array("friends"))->get();

			return View::make('users.profile')->withUser($user)->withPosts($posts);
			
		} else {
			
			$friends = $user->friends;
			$posts = $user->posts()->whereRaw('privacy like ?', array("public"))->get();
			return View::make('users.profile')->withUser($user)->withPosts($posts);
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
		$user = User::find($id);
		return View::make('users.edit_profile')->withUser($user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$input = Input::all();
		$v = Validator::make($input, User::$rules3);
		
		if ($v->passes()) {
		
			$user->fullname = $input['fullname'];
			$dob = $input['dob'];
			$dtime = DateTime::createFromFormat('d/m/Y', $dob);
			$timestamp = $dtime->getTimestamp();
			$user->dob = $timestamp;
			$user->save();
			
			return Redirect::route('user.show', $user->id);
		
		} else {
			
			return View::make('users.edit_profile')->withUser($user)->withErrors($v);
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
		//
	}
	
	/**
	 * 
	 * This function searchs for a user in the database
	 * 
	 */
	
	public function search()
	
	{
		$input = Input::all();
		$search = $input['search'];
		
		$v = Validator::make($input, User::$rules2);
		
		$users = User::whereRaw('fullname like ?', array($search) )->get();
	
		
		if ($v->passes())
		{
			$number = count($users);
	    	return View::make('users.search_results')->withUsers($users)->withNumber($number)->withSearch($search);
	    	
		} else {
			
			$users = User::all();
			$number = count($users);
		 	return View::make('users.search_results')->withUsers($users)->withNumber($number)->withErrors($v)->withSearch($search);
		 
		}
		
	
	}
	
	/**
	 * 
	 * This function finds a user and add it as friend
	 * 
	 */
	
	public function getFriendAdd($id)
	{
		$user = User::find($id);
		Auth::user()->addFriend($user);
		return Redirect::action('PostController@index');
		
		
	}
	
	/**
	 * 
	 * This function finds a user and remove it as friend
	 * 
	 */
	public function getFriendRemove($id)
	{
		$user = User::find($id);
		Auth::user()->removeFriend($user);
		return Redirect::action('PostController@index');
		
	}
	
	
	/**
	 * 
	 * This function retrieves a list of friends by parsing the user ID
	 * 
	 */
	
	public function listFriends($id)
	{
		
		$user = User::find($id);
		$friends = $user->friends;
		
		return View::make('users.friends_list')->withFriends($friends)->withUser($user);
		
	}
	
	/**
	 * 
	 * This function shows the profile of a given user by parsing its id as argument
	 * 
	 */
	
	public function showProfile($id)
	{
		$user = User::find($id);
		$posts = $user->posts;

		return View::make('users.user_profile')->withUser($user)->withPosts($posts);
		
	
	}
		
}
