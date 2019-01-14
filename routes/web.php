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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::view('template', 'misc.template')->name('template');
Route::get('foo', 'TestController@foo')->name('foo');


Route::get('fail/{errorCode?}', 'FailController@index')->name('fail');   //Sends the error code as a parameter to the failController's index function.
/*
*   Below is a hacky method to handle the failure page routing.
*   It is terrible coding practice and is only used as a placeholder until I can code the routing properly.
*/
Route::get('fail/unauthenticated', 'FailController@unauthenticated')->name('unauthenticated');
Route::get('fail/incorrectCredentials', 'FailController@incorrectCredentials')->name('incorrectCredentials');

Route::get('success/{successCode?}', 'SuccessController@index')->name('success');   //Sends the success code as a parameter to the SuccessController's index function.
/*
 *   Below is a hacky method to handle the success page routing.
 *   It is terrible coding practice and is only used as a placeholder until I can code the routing properly.
 */
Route::get('success/postSuccess', 'SuccessController@postSuccess')->name('postSuccess');
Route::get('success/registrationSuccess', 'SuccessController@registrationSuccess')->name('registrationSuccess');


Route::post('register', 'UserController@register')->name('register');
Route::post('login', 'UserController@login')->name('login');
Route::get('users/{username?}', 'UserController@page')->name('page');
Route::get('users', 'UserController@index')->name('users')->middleware('auth');

Route::post('createPost', 'PostController@createPost')->name('post.create')->middleware('auth');
Route::get('dashboard', 'PostController@dashboard')->name('dashboard')->middleware('auth');

