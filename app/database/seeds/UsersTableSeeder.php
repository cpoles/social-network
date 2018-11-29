<?php

class UsersTableSeeder extends Seeder {
    
    public function run() {
        
        User::create(array(
                
                'username' => 'bob@a.org',
                'fullname' => 'Bob',
                'dob' => new DateTime('1979-11-15'),
                'password' => Hash::make('1234')
            
            ));
        
        User::create(array(
                
                'username' => 'john@a.org',
                'fullname' => 'John',
                'dob' => new DateTime('1944-01-01'),
                'password' => Hash::make('1234')
            
            ));
        
        
         User::create(array(
                
                'username' => 'tom@a.org',
                'fullname' => 'Tom',
                'dob' => new DateTime('1988-04-23'),
                'password' => Hash::make('1234')
            
            ));
        
        
        
    }
    
    
}