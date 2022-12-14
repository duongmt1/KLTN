<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('errors-403', function() {
    return view('errors.403');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/login', 'LoginController@login')->name('admin.login');
        Route::post('/login', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('admin.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('admin.forgot.password');
    });

    Route::group(['middleware' =>['auth']], function() {
        Route::get('/home', 'HomeController@index')->name('home')->middleware('permission:truy-cap-he-thong|toan-quyen-quan-ly');

        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/','GroupPermissionController@index')->name('group.permission.index');
            Route::get('/create','GroupPermissionController@create')->name('group.permission.create');
            Route::post('/create','GroupPermissionController@store');

            Route::get('/update/{id}','GroupPermissionController@edit')->name('group.permission.update');
            Route::post('/update/{id}','GroupPermissionController@update');

            Route::get('/delete/{id}','GroupPermissionController@destroy')->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/','PermissionController@index')->name('permission.index');
            Route::get('/create','PermissionController@create')->name('permission.create');
            Route::post('/create','PermissionController@store');

            Route::get('/update/{id}','PermissionController@edit')->name('permission.update');
            Route::post('/update/{id}','PermissionController@update');

            Route::get('/delete/{id}','PermissionController@delete')->name('permission.delete');
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/','RoleController@index')->name('role.index')->middleware('permission:quan-ly-danh-sach-vai-tro|toan-quyen-quan-ly');
            Route::get('/create','RoleController@create')->name('role.create')->middleware('permission:tao-moi-vai-tro|toan-quyen-quan-ly');
            Route::post('/create','RoleController@store');

            Route::get('/update/{id}','RoleController@edit')->name('role.update')->middleware('permission:chinh-sua-vai-tro|toan-quyen-quan-ly');
            Route::post('/update/{id}','RoleController@update');

            Route::get('/delete/{id}','RoleController@delete')->name('role.delete')->middleware('permission:xoa-vai-tro|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/','UserController@index')->name('user.index')->middleware('permission:quan-ly-danh-sach-giao-vien|toan-quyen-quan-ly');
            Route::get('/create','UserController@create')->name('user.create')->middleware('permission:tao-moi-giao-vien|toan-quyen-quan-ly');
            Route::post('/create','UserController@store');

            Route::get('/update/{id}','UserController@edit')->name('user.update')->middleware('permission:chinh-sua-giao-vien|toan-quyen-quan-ly');
            Route::post('/update/{id}','UserController@update');

            Route::get('/delete/{id}','UserController@delete')->name('user.delete')->middleware('permission:xoa-giao-vien|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'position'], function(){
            Route::get('/','PositionController@index')->name('position.index')->middleware('permission:quan-ly-danh-sach-chuc-vu|toan-quyen-quan-ly');
            Route::get('/create','PositionController@create')->name('position.create')->middleware('permission:tao-moi-chuc-vu|toan-quyen-quan-ly');
            Route::post('/create','PositionController@store');

            Route::get('/update/{id}','PositionController@edit')->name('position.update')->middleware('permission:chinh-sua-chuc-vu|toan-quyen-quan-ly');
            Route::post('/update/{id}','PositionController@update');

            Route::get('/delete/{id}','PositionController@delete')->name('position.delete')->middleware('permission:xoa-chuc-vu|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'department'], function(){
            Route::get('/','DepartmentController@index')->name('department.index')->middleware('permission:quan-ly-danh-sach-khoa-bo-mon|toan-quyen-quan-ly');
            Route::get('/create','DepartmentController@create')->name('department.create')->middleware('permission:tao-moi-khoa-bo-mon|toan-quyen-quan-ly');
            Route::post('/create','DepartmentController@store');

            Route::get('/update/{id}','DepartmentController@edit')->name('department.update')->middleware('permission:chinh-sua-khoa-bo-mon|toan-quyen-quan-ly');
            Route::post('/update/{id}','DepartmentController@update');

            Route::get('/delete/{id}','DepartmentController@delete')->name('department.delete')->middleware('permission:xoa-khoa-bo-mon|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'course'], function(){
            Route::get('/','CourseController@index')->name('course.index')->middleware('permission:quan-ly-danh-sach-nien-khoa|toan-quyen-quan-ly');
            Route::get('/create','CourseController@create')->name('course.create')->middleware('permission:tao-moi-nien-khoa|toan-quyen-quan-ly');
            Route::post('/create','CourseController@store');

            Route::get('/update/{id}','CourseController@edit')->name('course.update')->middleware('permission:chinh-sua-nien-khoa|toan-quyen-quan-ly');
            Route::post('/update/{id}','CourseController@update');

            Route::get('/delete/{id}','CourseController@delete')->name('course.delete')->middleware('permission:xoa-nien-khoa|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'student'], function(){
            Route::get('/','StudentController@index')->name('student.index')->middleware('permission:quan-ly-danh-sach-sinh-vien|toan-quyen-quan-ly');
            Route::get('/create','StudentController@create')->name('student.create')->middleware('permission:tao-moi-sinh-vien|toan-quyen-quan-ly');
            Route::post('/create','StudentController@store');

            Route::get('/update/{id}','StudentController@edit')->name('student.update')->middleware('permission:chinh-sua-sinh-vien|toan-quyen-quan-ly');
            Route::post('/update/{id}','StudentController@update');

            Route::get('/delete/{id}','StudentController@delete')->name('student.delete')->middleware('permission:xoa-sinh-vien|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'topic'], function(){
            Route::get('/','TopicController@index')->name('topic.index')->middleware('permission:quan-ly-danh-sach-de-tai|toan-quyen-quan-ly');
            Route::get('/create','TopicController@create')->name('topic.create')->middleware('permission:tao-moi-de-tai|toan-quyen-quan-ly');
            Route::post('/create','TopicController@store');

            Route::get('/update/{id}','TopicController@edit')->name('topic.update')->middleware('permission:chinh-sua-de-tai|toan-quyen-quan-ly');
            Route::post('/update/{id}','TopicController@update');

            Route::get('/delete/{id}','TopicController@delete')->name('topic.delete')->middleware('permission:xoa-de-tai|toan-quyen-quan-ly');
        });


        Route::group(['prefix' => 'council'], function(){
            Route::get('/','CouncilController@index')->name('council.index')->middleware('permission:quan-ly-danh-sach-hoi-dong|toan-quyen-quan-ly');
            Route::get('/create','CouncilController@create')->name('council.create')->middleware('permission:tao-moi-hoi-dong|toan-quyen-quan-ly');
            Route::post('/create','CouncilController@store');

            Route::get('/update/{id}','CouncilController@edit')->name('council.update')->middleware('permission:chinh-sua-hoi-dong|toan-quyen-quan-ly');
            Route::post('/update/{id}','CouncilController@update');

            Route::get('/delete/{id}','CouncilController@delete')->name('council.delete')->middleware('permission:xoa-hoi-dong|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'topic-course'], function(){
            Route::get('/','TopicCourseController@index')->name('topic.course.index')->middleware('permission:quan-ly-danh-sach-de-tai-theo-nam|toan-quyen-quan-ly');
            Route::get('/create','TopicCourseController@create')->name('topic.course.create')->middleware('permission:tao-moi-de-tai-theo-nam|toan-quyen-quan-ly');
            Route::post('/create','TopicCourseController@store');

            Route::get('/update/{id}','TopicCourseController@edit')->name('topic.course.update')->middleware('permission:chinh-sua-de-tai-theo-nam|toan-quyen-quan-ly');
            Route::post('/update/{id}','TopicCourseController@update');

            Route::get('/delete/{id}','TopicCourseController@delete')->name('topic.course.delete')->middleware('permission:xoa-de-tai-theo-nam|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'notifications'], function(){
            Route::get('/','NotificationController@index')->name('notifications.index')->middleware('permission:quan-ly-danh-sach-thong-bao|toan-quyen-quan-ly');
            Route::get('/create','NotificationController@create')->name('notifications.create')->middleware('permission:tao-moi-thong-bao|toan-quyen-quan-ly');
            Route::post('/create','NotificationController@store');

            Route::get('/update/{id}','NotificationController@edit')->name('notifications.update')->middleware('permission:chinh-sua-thong-bao|toan-quyen-quan-ly');
            Route::post('/update/{id}','NotificationController@update');

            Route::get('/delete/{id}','NotificationController@delete')->name('notifications.delete')->middleware('permission:xoa-thong-bao|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'student-topics'], function(){
            Route::get('/','StudentTopicController@index')->name('student.topics.index')->middleware('permission:quan-ly-danh-sach-dang-ky-de-tai|toan-quyen-quan-ly');
            Route::get('/update/{id}','StudentTopicController@edit')->name('student.topics.update')->middleware('permission:nhan-set-va-cham-diem-de-tai|toan-quyen-quan-ly');
            Route::post('/update/outline{id}','StudentTopicController@updateOutline')->name('student.update.outline')->middleware('permission:nhan-set-va-cham-diem-de-tai|toan-quyen-quan-ly');
            Route::post('/update/thesis/book{id}','StudentTopicController@updateThesisBook')->name('student.update.thesis.book')->middleware('permission:nhan-set-va-cham-diem-de-tai|toan-quyen-quan-ly');
            Route::post('/update/student/topics{id}','StudentTopicController@updateStudentTopic')->name('update.student.topic')->middleware('permission:nhan-set-va-cham-diem-de-tai|toan-quyen-quan-ly');
            Route::get('/delete/{id}', 'StudentTopicController@delete')->name('student.topics.delete')->middleware('permission:xoa-de-tai-sinh-vien-dang-ky|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'admin'], function(){
            Route::get('/change/password','UserController@changePassword')->name('admin.change.password');
            Route::post('post/change/password', 'UserController@postChangePassword')->name('admin.post.change.password');
        });
    });
});

Route::group(['namespace' => 'Page'], function() {

    Route::group(['namespace' => 'Auth'], function() {
        Route::get('/', 'LoginController@login')->name('user.login');
        Route::post('/', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('user.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('user.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('user.forgot.password');
    });
    Route::group(['middleware' =>['student']], function() {

        Route::get('/home', 'HomeController@index')->name('user.home');
        Route::get('/topic/detail/{id}', 'TopicController@index')->name('topic.detail');
        Route::post('register/topic/{id}', 'TopicController@registerTopic')->name('register.topic');
        Route::get('topic/register/result', 'TopicController@topicRegisters')->name('topic.register.result');

        Route::group(['prefix' => 'user'], function(){
            Route::get('/profile', 'UserController@profile')->name('user.profile');
            Route::get('topic/register/details', 'UserController@registerDetails')->name('user.topic.details');
            Route::post('update/profile', 'UserController@updateProfile')->name('update.user.profile');

            Route::get('/outline', 'UserController@outline')->name('user.outline');
            Route::post('/post/outline/{id}', 'UserController@postOutline')->name('user.post.outline');

            Route::get('/thesis/book', 'UserController@thesisBook')->name('user.thesis.book');
            Route::post('/post/thesis/book/{id}', 'UserController@postThesisBook')->name('user.post.thesis.book');

            Route::get('cancel/registration/{id}', 'UserController@cancel')->name('user.cancel.registration');

            Route::get('change/password', 'UserController@changePassword')->name('user.change.password');
            Route::post('post/change/password', 'UserController@postChangePassword')->name('user.post.change.password');
        });
    });
});

