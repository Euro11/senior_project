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

Auth::routes();


Route::group(['middleware' => ['web','auth']], function(){
	// Route::get('/', function () {
	//     return view('welcome');
	// });
	
	Route::get('/', function() {
		if (Auth::user()->role == 1) {
			$user = Auth::user();
			return view('fontend.home', compact('user'));
		}else {
			$users['users'] = \App\User::all();
			return view('backend.adminhome', $users);
		}
	});
	// fontend
	Route::get('profile/{id}', 'HomeController@profile')->name('profile');
	Route::get('profile/edit/{id}', 'HomeController@edit')->name('profile.edit');
	Route::patch('profile/update/{id}', 'HomeController@update')->name('profile.update');
	Route::resource('/checkattendance', 'CheckAttendanceController');
	Route::resource('/statistic', 'StatisticController');

	// changepassword
	Route::get('/changepassword/{id}', 'backend\ManageUserController@changepassword');
	Route::post('/confirmpassword/{id}', 'backend\ManageUserController@confirmpassword');

	Route::resource('/managesubject', 'backend\subject\ManageSubjectController');
	Route::resource('/section', 'backend\subject\SectionController');
	Route::get('/section/CreateSection/{id}', 'backend\subject\SectionController@createSection')->name('section.CreateSection');
	Route::resource('/class', 'backend\subject\ClassroomController');

	Route::resource('/manageuser', 'backend\ManageUserController');
	Route::resource('/role', 'backend\RoleController');
	Route::resource('/week', 'backend\WeekController');
});