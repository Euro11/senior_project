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
			return redirect()->route('viewsubject.show', $user->id);
		}else {
			$users['users'] = \App\User::all();
			return view('backend.adminhome', $users);
		}
	});
	// frontend
	Route::get('profile/{id}', 'HomeController@profile')->name('profile');
	Route::get('profile/edit/{id}', 'HomeController@edit')->name('profile.edit');
	Route::patch('profile/update/{id}', 'HomeController@update')->name('profile.update');

	Route::resource('/viewsubject', 'ViewSubjectCotroller');
	Route::get('viewsubject/showMember/{id}{secID}', 'ViewSubjectCotroller@showMemberInGroup')->name('viewsubject.showMember');

	Route::resource('/checkattendance', 'CheckAttendanceController');
	Route::post('/checkattendance/check/{id}', 'CheckAttendanceController@check')->name('checkattendance.check');
	Route::resource('/statistic', 'StatisticController');

	// backend
	// changepassword
	Route::get('/changepassword/{id}', 'backend\ManageUserController@changepassword');
	Route::post('/confirmpassword/{id}', 'backend\ManageUserController@confirmpassword');

	Route::resource('/managesubject', 'backend\subject\ManageSubjectController');
	Route::resource('/section', 'backend\subject\SectionController');
	Route::get('/section/CreateSection/{id}', 'backend\subject\SectionController@createSection')->name('section.CreateSection');
	Route::post('/section/CheckButtonStatus/{id}', 'backend\subject\SectionController@updateStatus')->name('section.updatestatus');
	Route::resource('/class', 'backend\subject\ClassroomController');

	Route::resource('/ManageCheckAttendance', 'backend\ManageCheckAttendanceController');
	Route::resource('/ViewStatistics', 'backend\ViewStatisticsController');
	Route::resource('/manageuser', 'backend\ManageUserController');
	Route::resource('/role', 'backend\RoleController');
	Route::resource('/week', 'backend\WeekController');
});