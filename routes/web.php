<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use App\Models\User;








Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'guest'], function () {
		Route::get('/', 'HomeController@index')->name('home');
		Route::get('/home', 'HomeController@index')->name('home');
		});

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Auth::routes();


// Routes Application Form
Route::group(['middleware' => 'application'], function () {
	Route::get('general/application', 'applicationFormController@index')->name('application');
	Route::post('general/application-push', 'applicationFormController@applicationpush')->name('applicationpush');
	Route::get('general/applicationback', 'applicationFormController@applicationback')->name('applicationback');
	});


// Routes Adminpage
Route::group(['middleware' => 'admin'], function () {
	Route::get('/adminpage', 'adminPageController@index')->name('adminpage');
	Route::post('/adminpage/delete/{id}', 'adminPageController@deleteUser')->name('adminpagedelete');
	Route::get('/adminpages/endedit/{id}', 'adminPageController@editUser')->name('adminpagesendedit');
	Route::post('/adminpages/endeditsubmit/{id}', 'adminPageController@editSubmit')->name('adminpagesendeditsubmit');
	Route::post('/adminpages/endeditrights/{id}', 'adminPageController@endeditrights')->name('adminpageendeditrights');
	Route::post('/adminpages/add', 'adminPageController@adminpagesadd')->name('adminpagesadd');
	Route::get('/useradd', 'adminPageController@useradd')->name('useradd');
});


// Routes ApplicationCheck
Route::group(['middleware' => 'applicationcheck'], function () {
	Route::get('/applicationcheck', 'applicationCheckController@index')->name('applicationcheck');
	Route::get('/applicationcheck/popup', 'applicationCheckController@index')->name('applicationcheckpopup');
	Route::get('/applicationcheck/edit/{id}', 'applicationCheckController@editapplication')->name('applicationcheckedit');
});

// Routes History
Route::group(['middleware' => 'application'], function () {
	Route::get('/history', 'historyController@index')->name('history');
	Route::get('/history/view/{id}', 'historyController@historyview')->name('historyview');
});


// Routes Status & Remark & Login/Logout
Route::post('/applicationcheck/status/{id}', 'applicationCheckController@status')->name('status');
Route::post('/pushremark/{id}', 'applicationCheckController@pushremark')->name('pushremark');

Route::get('/newpassword', 'homeController@newpassword')->name('newpassword');
Route::post('/submitPassword', 'homeController@submitPassword')->name('submitPassword');
