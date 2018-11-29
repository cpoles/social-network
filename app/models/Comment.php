<?php

class Comment extends Eloquent {
    
     /**
	 * Validation rules for the post object
	 *
	 * 
	 */
    public static $rules = array(
		
			'message' => 'required'
		
		);
    
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
	 * Relationship function with the posts table
	 * 
	 */
    public function posts()
    {
        return $this->belongsTo('Post');
    }
    
     /**
	 * 
	 * Function that returns the interval between now and the date the comment was created and formats the result
	 * 
	 */
    public function getTime($from) {
        
        $from_date = new DateTime($from);
        $to_date = new DateTime('now');
        
        $interval = $from_date->diff($to_date);
        
        return $interval->d." days, " . $interval->h."hours ";
        
    }
    
     /**
	 * 
	 * Function that retrieves a given post by parsing the comment ID
	 * 
	 */
    public function getPost($commentID) {
        
        $comment = Comment::find($commentID);
        
        $postID = $comment->post_id;
        
        $post = Post::find($postID);
    
        return $post;
        
    }
    
     /**
	 * 
	 * Function that retrieves the author of a post by parsing the comment ID
	 * 
	 */
    public function getCommentAuthor($commentID) {
        
        $sql = "select fullname from users, comments  where comments.user_id = users.id and comments.id like ?";
       $results = DB::select($sql, array($commentID));
       $author = $results[0];
        
        return $author->fullname;
    }
}


?>