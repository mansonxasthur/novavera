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

Route::get('/', 'HomeController@index')->name('home');


Auth::routes();
Route::get('/register', function () {
    abort(404);
});
Route::post('/register', function () {
    abort(403);
});

/******************** Admin Area ************************/
Route::prefix('dashboard')->namespace('Admin')->group(function() {
    Route::get('', 'DashboardController@index')->name('dashboard');

    // Locations
    Route::get('locations', 'LocationController@index')->name('admin.locations.index');
    Route::post('locations', 'LocationController@store')->name('admin.locations.store');
    Route::put('locations/{location}', 'LocationController@update')->name('admin.locations.update');
    Route::delete('locations/{location}', 'LocationController@destroy')->name('admin.locations.destroy');

    // Property Types
    Route::get('property-types', 'PropertyTypeController@index')->name('admin.propertyTypes.index');
    Route::post('property-types', 'PropertyTypeController@store')->name('admin.propertyTypes.store');
    Route::put('property-types/{propertyType}', 'PropertyTypeController@update')->name('admin.propertyTypes.update');
    Route::delete('property-types/{propertyType}', 'PropertyTypeController@destroy')->name('admin.propertyTypes.destroy');

    // Developers
    Route::get('developers', 'DeveloperController@index')->name('admin.developers.index');
    Route::post('developers', 'DeveloperController@store')->name('admin.developers.store');
    Route::post('developers/{developer}', 'DeveloperController@update')->name('admin.developers.update');
    Route::delete('developers/{developer}', 'DeveloperController@destroy')->name('admin.developers.destroy');

    // Departments
    Route::get('departments', 'DepartmentController@index')->name('admin.departments.index');
    Route::post('departments', 'DepartmentController@store')->name('admin.departments.store');
    Route::put('departments/{department}', 'DepartmentController@update')->name('admin.departments.update');
    Route::delete('departments/{department}', 'DepartmentController@destroy')->name('admin.departments.destroy');

    // Projects
    Route::get('projects', 'ProjectController@index')->name('admin.projects.index');
    Route::get('projects/create', 'ProjectController@create')->name('admin.projects.create');
    Route::post('projects', 'ProjectController@store')->name('admin.projects.store');
    Route::get('projects/{project}/edit', 'ProjectController@edit')->name('admin.projects.edit');
    Route::post('projects/{project}', 'ProjectController@update')->name('admin.projects.update');
    Route::delete('projects/{project}', 'ProjectController@destroy')->name('admin.projects.destroy');

    // Tags
    Route::get('tags', 'TagController@index')->name('admin.tags.index');
    Route::post('tags', 'TagController@store')->name('admin.tags.store');
    Route::put('tags/{tag}', 'TagController@update')->name('admin.tags.update');
    Route::delete('tags/{tag}', 'TagController@destroy')->name('admin.tags.destroy');

    // Posts
    Route::get('posts', 'PostController@index')->name('admin.posts.index');
    Route::get('posts/create', 'PostController@create')->name('admin.posts.create');
    Route::post('posts', 'PostController@store')->name('admin.posts.store');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('admin.posts.edit');
    Route::post('posts/{post}', 'PostController@update')->name('admin.posts.update');
    Route::post('posts/{post}/publish', 'PostController@togglePublish')->name('admin.posts.togglePublish');
    Route::delete('posts/{post}', 'PostController@destroy')->name('admin.posts.destroy');

    // Pages
    Route::get('pages', 'PageController@index')->name('admin.pages.index');
    Route::get('pages/create', 'PageController@create')->name('admin.pages.create');
    Route::post('pages', 'PageController@store')->name('admin.pages.store');
    Route::get('pages/{page}/edit', 'PageController@edit')->name('admin.pages.edit');
    Route::post('pages/{page}', 'PageController@update')->name('admin.pages.update');
    Route::post('pages/{page}/publish', 'PageController@togglePublish')->name('admin.pages.togglePublish');
    Route::delete('pages/{page}', 'PageController@destroy')->name('admin.pages.destroy');

    // Sliders
    Route::get('sliders', 'SliderController@index')->name('admin.sliders.index');
    Route::get('sliders/{slider}/edit', 'SliderController@edit')->name('admin.sliders.edit');
    Route::post('sliders', 'SliderController@store')->name('admin.sliders.store');
    Route::post('sliders/{slider}/main', 'SliderController@toggleMain')->name('admin.sliders.toggleMain');
    Route::post('sliders/{slider}/images', 'SliderController@addSlide')->name('admin.sliders.addSlide');
    Route::post('sliders/{slider}/images/{sliderImage}', 'SliderController@updateSlide')->name('admin.sliders.updateSlide');
    Route::delete('sliders/{slider}/images/{sliderImage}', 'SliderController@removeSlide')->name('admin.sliders.removeSlide');
    Route::put('sliders/{slider}', 'SliderController@update')->name('admin.sliders.update');
    Route::delete('sliders/{slider}', 'SliderController@destroy')->name('admin.sliders.destroy');
});

/******************** Public Area ************************/

// Projects
Route::get('/projects/{project}', 'ProjectController@show');

// Developers
Route::get('/developers', 'DeveloperController@index');
Route::get('/developers/{developer}', 'DeveloperController@show');