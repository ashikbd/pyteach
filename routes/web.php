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

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::post('/create_user','\App\Http\Controllers\Auth\RegisterController@register');
Route::get('/adminlogin', '\App\Http\Controllers\Auth\LoginController@secureLogin');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/students/dashboard', '\App\Http\Controllers\Students@dashboard');
Route::get('/learning/topics', '\App\Http\Controllers\LearningController@topics');
Route::get('/learning/topic_detail/{id}', '\App\Http\Controllers\LearningController@topic_detail');
Route::post('/learning/submit_quiz','\App\Http\Controllers\LearningController@submit_quiz');
Route::post('/learning/save_progress','\App\Http\Controllers\LearningController@save_progress');
Route::post('/learning/reset_quiz','\App\Http\Controllers\LearningController@reset_quiz');
Route::get('/students/certificate', '\App\Http\Controllers\Students@certificate');
Route::get('/view_certificate/{id}', '\App\Http\Controllers\HomeController@view_certificate');
Route::get('/students/linked_parents', '\App\Http\Controllers\Students@linked_parents');
Route::get('/parents/dashboard', '\App\Http\Controllers\ParentController@dashboard');
Route::get('/parents/linked_students', '\App\Http\Controllers\ParentController@linked_students');
Route::get('/parents/approve_invitation/{id}', '\App\Http\Controllers\ParentController@approve_invitation');
Route::get('/parents/deny_invitation/{id}', '\App\Http\Controllers\ParentController@deny_invitation');
Route::get('/parents/unlink_student/{id}', '\App\Http\Controllers\ParentController@unlink_student');
Route::get('/parents/student_certificate/{id}', '\App\Http\Controllers\ParentController@student_certificate');
Route::get('/students/statistics', '\App\Http\Controllers\Students@statistics');
Route::get('/parents/student_statistics/{id}', '\App\Http\Controllers\ParentController@student_statistics');
Route::post('/students/send_invitation', '\App\Http\Controllers\Students@send_invitation');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'admin'], function()
{
    // only /admin/ routes in here that will be in a namespace folder of "backend" with admin middleware
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('learning', 'LearningMngmntController@index')->name('learning');
    Route::get('learning/topic_add', 'LearningMngmntController@topic_add');
    Route::post('learning/topic_save', 'LearningMngmntController@topic_save');
    Route::get('learning/topic_learning/{id}', 'LearningMngmntController@topic_learning');
    Route::get('learning/topic_learning_add/{id}', 'LearningMngmntController@topic_learning_add');
    Route::post('learning/learning_save', 'LearningMngmntController@learning_save');
    Route::post('learning/topic_learning_delete','LearningMngmntController@topic_learning_delete');
    Route::get('learning/topic_learning_edit/{id}', 'LearningMngmntController@topic_learning_edit');
    Route::post('learning/learning_update', 'LearningMngmntController@learning_update');
    Route::get('learning/topic_practice/{id}', 'LearningMngmntController@topic_practice');
    Route::get('learning/topic_practice_add/{id}', 'LearningMngmntController@topic_practice_add');
    Route::get('learning/topic_practice_edit/{id}', 'LearningMngmntController@topic_practice_edit');
    Route::post('learning/practice_save', 'LearningMngmntController@practice_save');
    Route::post('learning/practice_update', 'LearningMngmntController@practice_update');
    Route::post('learning/topic_practice_delete','LearningMngmntController@topic_practice_delete');
    Route::get('learning/topic_quiz/{id}', 'LearningMngmntController@topic_quiz');
    Route::get('learning/topic_quiz_add/{id}', 'LearningMngmntController@topic_quiz_add');
    Route::post('learning/quiz_save', 'LearningMngmntController@quiz_save');
    Route::get('learning/topic_quiz_edit/{id}', 'LearningMngmntController@topic_quiz_edit');
    Route::post('learning/quiz_update', 'LearningMngmntController@quiz_update');
    Route::post('learning/topic_quiz_delete','LearningMngmntController@topic_quiz_delete');
    Route::get('students', 'StudentsController@index');
    Route::get('parents', 'ParentsController@index');
});
