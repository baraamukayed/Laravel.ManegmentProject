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


///////////////////////// ADMIN /////////////////////////


Route::group(['prefix' => 'admin' , 'middleware'=>'auth'], function () {

    Route::get('/index','AdminController@index')->name('admin.index');
    // Teacher
    Route::get('/showTeachers','AdminController@showTeachers')->name('admin.showTeachers');
    Route::post('/addTeacher','AdminController@addTeacher')->name('admin.addTeacher');
    Route::get('/ShowAddTeacher','AdminController@ShowAddTeacher')->name('admin.ShowAddTeacher');
    Route::delete('/deleteTeacher/{id}','AdminController@deleteTeacher')->name('admin.deleteTeacher');
    Route::get('editTeacher/{id}','AdminController@editTeacher')->name('admin.editTeacher');
    Route::put('updateTeacher/{id}','AdminController@updateTeacher')->name('admin.updateTeacher');
    // Student
    Route::get('/showStudents','AdminController@showStudents')->name('admin.showStudents');
    Route::post('/addStudent','AdminController@addStudent')->name('admin.addStudent');
    Route::get('/showAddStudent','AdminController@showAddStudent')->name('admin.showAddStudent');
    Route::delete('/deleteStudent/{id}','AdminController@deleteStudent')->name('admin.deleteStudent');
    Route::get('editStudent/{id}','AdminController@editStudent')->name('admin.editStudent');
    Route::put('updateStudent/{id}','AdminController@updateStudent')->name('admin.updateStudent');
    //Project
    Route::get('/showAddNewProject','AdminController@showAddNewProject')->name('admin.showAddNewProject');
    Route::post('/addProject','AdminController@addProject')->name('admin.addProject');
    Route::get('/showSuggestedProject','AdminController@showSuggestedProject')->name('admin.showSuggestedProject');
    Route::get('/allStudentsProjects','AdminController@allStudentsProjects')->name('admin.allStudentsProjects');
    Route::get('/editProject/{id}','AdminController@editProject')->name('admin.editProject');
    Route::put('/updateProject/{id}','AdminController@updateProject')->name('admin.updateProject');
    Route::delete('/deleteProject/{id}','AdminController@deleteProject')->name('admin.deleteProject');
    Route::get('/suggestedProjectFromTeacher','AdminController@suggestedProjectFromTeacher')->name('admin.suggestedProjectFromTeacher');
    Route::get('acceptProjectFromTeacher/{id}','AdminController@acceptProjectFromTeacher')->name('admin.acceptProjectFromTeacher');
    //discusstions
    Route::get('/showAddDiscussions','AdminController@showAddDiscussions')->name('admin.showAddDiscussions');
    Route::post('/addDiscussions','AdminController@addDiscussions')->name('admin.addDiscussions');
    Route::get('/allDiscussions','AdminController@allDiscussions')->name('admin.allDiscussions');
    Route::get('/editDiscussion/{id}','AdminController@editDiscussion')->name('admin.editDiscussion');
    Route::put('/updateDiscussion/{id}','AdminController@updateDiscussion')->name('admin.updateDiscussion');
    Route::delete('/deleteDiscussion/{id}','AdminController@deleteDiscussion')->name('admin.deleteDiscussion');

    Route::get('cv/{uuid}/download', 'AdminController@download')->name('admin.download');
    Route::get('explanatory/{uuid}/download', 'AdminController@downloadexplanatory')->name('admin.downloadexplanatory');


    });

        ///////////////////////// TEACHER /////////////////////////

    Route::group(['prefix' => 'teacher' , 'middleware'=>'auth'], function () {

        route::get('/index','TeacherController@index')->name('teacher.index');
        route::get('/dataOfTeacher','TeacherController@dataOfTeacher')->name('teacher.dataOfTeacher');
        route::get('/editYourData/{id}','TeacherController@editYourData')->name('teacher.editYourData');
        route::put('/updateYourData/{id}','TeacherController@updateYourData')->name('teacher.updateYourData');
        route::get('/allTeachers','TeacherController@allTeachers')->name('teacher.allTeachers');
        route::get('/showSuggestedNewProject','TeacherController@showSuggestedNewProject')->name('teacher.showSuggestedNewProject');
        route::post('/suggestedNewProject','TeacherController@suggestedNewProject')->name('teacher.suggestedNewProject');
        route::get('allProject','TeacherController@allProject')->name('teacher.allProject');
        route::get('allDiscussions','TeacherController@allDiscussions')->name('teacher.allDiscussions');


    });


            ///////////////////////// STUDENT /////////////////////////

            Route::group(['prefix' => 'student' , 'middleware'=>'auth'], function () {

                route::get('/index','StudentController@index')->name('student.index');
                route::get('/dataOfStudent','StudentController@dataOfStudent')->name('student.dataOfStudent');
                route::get('/editYourData/{id}','StudentController@editYourData')->name('student.editYourData');
                route::put('/updateYourData/{id}','StudentController@updateYourData')->name('student.updateYourData');
                route::get('/suggestedProjects','StudentController@suggestedProjects')->name('student.suggestedProjects');
                route::put('/selectProject/{id}','StudentController@selectProject')->name('student.selectProject');
                route::put('/deleteProject/{id}','StudentController@deleteProject')->name('student.deleteProject');
                route::get('/discussions','StudentController@discussions')->name('student.discussions');
                // route::get('/showAddGroup','StudentController@showAddGroup')->name('student.showAddGroup');
                // route::post('/addGroup','StudentController@addGroup')->name('student.addGroup');
                // route::get('/showGroup','StudentController@showGroup')->name('student.showGroup');

            });



            /////////////////


Auth::routes([
    'register' => false,
]
);

Route::get('/home', 'HomeController@index')->name('home');
