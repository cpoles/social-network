<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class User extends Eloquent implements UserInterface, RemindableInterface, StaplerableInterface {
	
	use UserTrait, RemindableTrait, EloquentTrait;
	
	// Validation rules for creating a user
	public static $rules = array(
		
			'username' => 'required|email|unique:users',
			'fullname' => 'required',
			'password' => 'required|confirmed',
			'dob' => 'required|date_format:d/m/Y'
		
		);
	
	// Validation rules for searching for a user
	public static $rules2 = array(
		
			'search' => 'required|min:3'
		
		);
	
	// Validation rules for editing a user
	public static $rules3 = array(
		
			'fullname' => 'required',
			'dob' => 'required|date_format:d/m/Y'
	);


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	/**
	 *  Constructor for adding files to this model
	 */ 
	 
	 public function _construct(array $attributes = array()) {
	 	
	 	$this->hasAttachedFile('image', [
	 			'styles' => [ 
	 				'medium' =>	'300x300',
	 				'thumb' => '100x100'
 			]
	 	]);
	 	
	 	parent::_construct($attributes);
	 }
	 
	/**
	 * Relationship with the friends table
	 * 
	 */
	 
	 public function comments()
	 {
	 	return $this->hasMany('Comment');
	 }
	
		/**
	 * Relationship with the posts table
	 * 
	 */	
	 public function posts()
	 {
	 	return $this->hasMany('Post');
	 }
	
	/**
	 * Relationship with the friends table
	 * 
	 */
	 
	public function friends()
	{
		return $this->belongsToMany('User', 'friends_users', 'user_id', 'friend_id');
	}
	
	public function getDates() 
	{
		return array('dob');
	}
	
	/**
	 * Function that calculates the user's age by parsing its D.O.B
	 * 
	 */
	 public function getUserAge($from)
	 {
	 	$from_date = new DateTime($from);
        $to_date = new DateTime('now');
        
        $interval = $from_date->diff($to_date);
        
        return $interval->y." years old.";
	 }
	 
	 /**
	 *  Function that adds a friend by taking an user as argument

	 */ 

	public function addFriend(User $user)
	{
		$this->friends()->attach($user->id);
		$user->friends()->attach($this->id);
	}
	
	/**
	 *  Function that removes a friend by taking an user as argument
	 */ 
	
	public function removeFriend(User $user)
	{
		$this->friends()->detach($user->id);
		$user->friends()->detach($this->id);
	}
	
	/**
	 *  Function that checks whether a user is friend with another user by parsing the 
	 *  the other person's id
	 */ 
	public function isFriendWith($id)
	{
		
		$userID = Auth::user()->id;
		
		$friend = $this->friends()->where('friend_id', '=', $id)->where('user_id', '=', $userID)->orWhere('friend_id', '=', $userID)->where('user_id', '=', $id)->first();
		
		if (!$friend) {
			
			return false;
			
		} else {
			
			return true;
		}
	}
	
	
	
}
