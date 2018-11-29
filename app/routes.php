<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'PostController@index'));

Route::post('user/login', array('as' => 'user.login', 'uses' => 'UserController@login'));
Route::get('user/logout', array('as' => 'user.logout', 'uses' => 'UserController@logout'));

Route::get('users/login_page', array('as' => 'login.page', 'uses' => 'UserController@index'));
Route::post('users/search_results', array('as => user.search', 'uses' => 'UserController@search'));

Route::get('users/profile/{id}', array('as' => 'add.friend', 'uses' => 'UserController@getFriendAdd'));
Route::get('users/friends_list/{id}', array('as' => 'list.friend', 'uses' => 'UserController@listFriends'));
Route::get('user/friends_list/{id}', array('as' => 'remove.friend', 'uses' => 'UserController@getFriendRemove'));
Route::get('users/user_profile/{id}', array('as' => 'show.profile', 'uses' => 'UserController@showProfile'));


Route::resource('user', 'UserController');
Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');

Route::get('requirements', function()
{
    return View::make('docs.requirements');

});

Route::get('erdiagram', function() 
{
    return View::make('docs.erd');
    
}
);

Route::get('sitediagram', function()
{
    return View::make('docs.sitediagram');

});