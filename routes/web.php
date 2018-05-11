<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function(){

	Route::get('/', function () {
    return view('welcome');
	})->name('home');

	Route::get('/dashboard', [ 'uses'=>'PostController@getDashboard'])->name('dashboard');


	Route::post('/login', ['as' =>'login', 'uses'=>'UserController@postSignIn']);

	Route::post('/signup', ['as' =>'signup', 'uses'=>'UserController@Signup']);


	Route::post('/createpost', ['as' =>'post.create', 'uses'=>'PostController@postCreatePost', 'middleware'=>'auth']);

	Route::get('/logout', ['as' =>'logout', 'uses'=>'UserController@Logout']);

	Route::get('/deletepost/{post_id}', ['as' =>'post.delete', 'uses'=>'PostController@getDeletePost', 'middleware'=>'auth']);
	
//edit the posts 

	Route::post('/edit', [	'uses'=> 'PostController@postEditPost' 	]) ->name('edit');

//image processing 
	Route::get('/account', [	'uses'=> 'UserController@getAccount' 	]) ->name('account');

//save image 
	Route::post('/updateaccount', ['uses'=> 'UserController@postSaveAccount' 	]) ->name('account.save');
//get image
	Route::get('/userimage/{filename}', ['uses'=> 'UserController@getUserImage']) ->name('account.image');

	Route::get('/like', ['uses'=> 'UserController@postLikePost']) ->name('like');


});
