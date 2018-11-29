<?php

class Post extends Eloquent {
    
    /**
	 * Validation rules for the post object
	 *
	 * 
	 */
    public static $rules = array(
		
			'title' => 'required',
			'message' => 'required'
		
		);

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';
	
	
	/**
	 * 
	 * Relationship function with the users table
	 * 
	 */
     public function users()
    {
        return $this->belongsTo('User');
    }
    
    /**
	 * 
	 * Relationship function with the comments table
	 * 
	 */
    public function comments()
    {
        return $this->hasMany('Comment');
    }
    
    
    /**
	 * 
	 * function that retrives the post's author name by parsing the post id
	 * 
	 */
    function getPostAuthor($postID) {
        
       $sql = "select fullname from users, posts  where posts.user_id = users.id and posts.id like ?";
       $results = DB::select($sql, array($postID));
       $author = $results[0];
        
        return $author->fullname;
        
    }
    
    /**
	 * 
	 * function that retrives the post's author
	 * 
	 */
    function getUser($postID) {
        
       $sql = "select fullname from users, posts  where posts.user_id = users.id and posts.id like ?";
       $results = DB::select($sql, array($postID));
       $author = $results[0];
        
        return $author;
        
    }
    
    /**
	 * 
	 * function that returns the interval from now and the post creation formatted date 
	 * 
	 */
    function getNumberOfDaysAndHours($from) {
        
        $from_date = new DateTime($from);
        $to_date = new DateTime('now');
        
        $interval = $from_date->diff($to_date);
        
        return $interval->d." days, " . $interval->h."hours ";
   
    }
    
    /**
	 * 
	 * function that returns the number of comments of a given post by parsing the post_id
	 * 
	 */
    public function getNumberOfComments($postID) {
        
        $comments = Post::find($postID)->comments;
        $numberOfComments = count($comments);
        
        return $numberOfComments;
    }
    
    /**
	 * 
	 * function that returns the comments of a given post and sorts the array by date created.
	 * 
	 */
    
    public function getComments($postID) {
        
        $comments = Post::find($postID)->comments;
        
        return $comments->sortByDesc('created_at');
        
    }
}