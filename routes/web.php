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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/student', 'StudentController@index');
Route::post('/student', 'StudentController@index');


Route::get('/viewstdjson', 'StudentController@viewstdjson');
Route::post('/viewstdsjsonpost', 'StudentController@viewstdsjsonpost');

Route::get('/viewstdimage', 'StudentController@viewstdimage');
//Route::get('/getstdimagebase64/{semid}/{stdid}', 'StudentController@getstdimagebase64');
Route::get('/DownloadImage/{semid}/{stdid}/{hash}', 'StudentController@DownloadImage');

Route::get('/viewstdadmin', 'StudentController@viewstdadmin');

Route::get('/dormfilepdf/{std}', 'StudentController@DormFilePDF');
Route::get('/leavefilepdf/{std}', 'StudentController@LeaveFilePDF');

Route::get('/createstudent', 'StudentController@CreateStudent');
Route::post('/createstudentjson', 'StudentController@createstudentjson');


Route::get('/editstudent/{id}', 'StudentController@editstudent');
Route::post('/EditStudentJson', 'StudentController@EditStudentJson');
Route::post('/delstudentjson', 'StudentController@DelStudentJson');

//Route::get('/artist/{id}/{name}', 'HomeController@artist')->where(['id' => '[0-9]+', 'name' => '[a-z]+'])->name('artist');
Route::get('/addlate/{semid}/{stdid}', 'LateController@addlate');
Route::get('/addlate', 'LateController@AddLateIndex');
Route::post('/addlatejson', 'LateController@addlatejson');

Route::get('/viewlate', 'LateController@viewlate');
Route::post('/viewlatejson', 'LateController@viewlatejson');
Route::get('/lateform/{semid}/{stdid}', 'LateController@lateform');