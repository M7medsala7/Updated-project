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


Route::get('/', 'Home\IndexController@index');

Route::group(['middleware' => 'guest'], function () {
    Route::post('/registeremployer', '\App\Http\Controllers\Auth\RegisterController@emplyReg');
	Route::post('/registercandidate', '\App\Http\Controllers\Auth\RegisterController@candReg');
	Route::get('/register/type','Auth\RegisterController@empFullRegType');
	Route::get('/f_register/employeer','Auth\RegisterController@empFullReg');
	Route::post('/f_reg/employer','Auth\RegisterController@f_reg_emp');
	Route::get('/f_register/candidate','Auth\RegisterController@candFullReg');
	Route::post('/f_reg/candidate','Auth\RegisterController@f_reg_cand');

	Route::get('/signup', function () {
	    return view('auth.signup');
	});
	Route::get('/register/employeer', function () {
	    return view('auth.employer_type');
	});
	Route::get('/register/candidates', function () {
	    return view('auth.candidate_register');
	});
	Route::get('/register/employer', function () {

	    return view('auth.employer_register');
	});
	Route::get('/congrats', function () {

	    return view('auth.congratulation');
	});
	
	Route::get('/getCities/{id}','CountryController@getCities');

});
Route::any('/StoreVideo', '\App\Http\Controllers\Auth\RegisterController@StoreVideo');
Route::get('/getNextTopCandidates/{id?}','HomeController@getNextTopCandidates');
Route::get('/getNextJobCandidates/{id?}','HomeController@getNextJobCandidates');


Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/company_profile', function () {

	    return view('employer.company_profile');
	});
//***************************Employer Regestration Facebook and google*************************

Route::get('/auth/facebook/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvider')->name('login.facebook');
Route::get('/facebook/callback','\App\Http\Controllers\Auth\RegisterController@handleProvider');
Route::get('/auth/google/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProviderGoogle')->name('login.google');
Route::get('/google/callback','\App\Http\Controllers\Auth\RegisterController@handleProviderGooglr');

Route::get('/auth/twitter/{id}','\App\Http\Controllers\Auth\RegisterController@redirectToProvidertwitter')->name('login.twitter');
Route::get('/twitter/callback','\App\Http\Controllers\Auth\RegisterController@handleProvidertwitter');

/*************************************************************************/


/*********
**Search**
**********/
Route::get('/search','Home\IndexController@search');

/***********************************Admin routes**************************************/
Route::get('/PostJob','\App\Http\Controllers\Dashboard\PostJobController@index');


/*************************************************************************/