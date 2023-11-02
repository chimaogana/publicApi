<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//News

Route::get('/get-all-news', 'ApiController\NewsController@index')->middleware('cors');
Route::get('/get-news-by-id/{id}', 'ApiController\NewsController@show')->middleware('cors');
Route::get('/get-news-by-item-type/{type}', 'ApiController\NewsController@showByNewsItemType')->middleware('cors');
Route::get('/get-news-item-types', 'ApiController\NewsController@getNewsItemTypes')->middleware('cors');

//Units
Route::get('/get-all-units', 'ApiController\UnitsController@index')->middleware('cors');
Route::get('/get-unit-by-id/{id}', 'ApiController\UnitsController@show')->middleware('cors');
Route::get('/get-units-by-unit-module/{unit_module}', 'ApiController\UnitsController@showByUnitModule')->middleware('cors');

//College
Route::get('/get-college-departments/{unit_id}', 'ApiController\UnitsController@showCollegeDept')->middleware('cors');

//Dept
Route::get('/get-department-courses/{unit_id}', 'ApiController\UnitsController@showDepartmentCourses')->middleware('cors');
Route::get('/get-department-acad-programs/{unit_id}', 'ApiController\UnitsController@showDepartmentPrograms')->middleware('cors');

//Courses
Route::get('/get-all-courses', 'ApiController\CoursesController@index')->middleware('cors');
Route::get('/get-course-by-id/{id}', 'ApiController\CoursesController@show')->middleware('cors');
Route::get('/get-course-topics/{course_id}', 'ApiController\CoursesController@showCourseTopics')->middleware('cors');

//academic program
Route::get('/get-all-acad-program', 'ApiController\AcadProgramsController@index')->middleware('cors');
Route::get('/get-acad-program-by-id/{id}', 'ApiController\AcadProgramsController@show')->middleware('cors');
Route::get('/get-acad-program-by-unit/{unit_id}', 'ApiController\AcadProgramsController@showByUnit')->middleware('cors');

//degree
Route::get('/get-all-degree', 'ApiController\DegreeController@index')->middleware('cors');
Route::get('/get-degree-by-id/{id}', 'ApiController\DegreeController@show')->middleware('cors');

//Event
Route::get('/get-all-events', 'ApiController\EventsController@index')->middleware('cors');
Route::get('/get-event-by-id/{id}', 'ApiController\EventsController@show')->middleware('cors');

//Degree Title
Route::get('/get-all-degree-title', 'ApiController\DegreeTitleController@index')->middleware('cors');
Route::get('/get-degree-title-by-id/{id}', 'ApiController\DegreeTitleController@show')->middleware('cors');

//StaffPerson
Route::get('/get-staff-by-id/{id}', 'ApiController\StaffPersonController@Show')->middleware('cors');
