<?php 

class CommentsTableSeeder extends Seeder {
    
    public function run() {
        Comment::create(array (
            
                'message' =>  'comment 1',
                'post_id' => '1',
                'user_id' => '1'
            ));
            
        Comment::create(array (
            
                'message' =>  'comment 2',
                'post_id' => '2',
                'user_id' => '2'
            
            ));
            
        Comment::create(array (
            
                'message' =>  'comment 3',
                'post_id' => '3',
                'user_id' => '3'
            
            ));
    }
}