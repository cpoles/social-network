<?php

class PostsTableSeeder extends Seeder {
    
    public function run() {
        
        Post::create(array( 
            
                'user_id' => '1',
                'title' => 'Bob\'s post 1',
                'message' => 'Bob\'s private post 1',
                'privacy' => 'private'
            
            ));
            
        Post::create(array( 
            
                'user_id' => '2',
                'title' => 'John\'s post 2',
                'message' => 'John\'s public post 2',
                'privacy' => 'public'
            
            ));
            
        Post::create(array( 
            
                'user_id' => '3',
                'title' => 'Tom\'s post 3',
                'message' => 'Tom\'s friends post 3',
                'privacy' => 'friends'
            
            ));
    }
    
    
}