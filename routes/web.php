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
Route::prefix('dashboard')->namespace('Admin')->middleware('auth')->group(function() {
    Route::get('', 'DashboardController@index')->name('dashboard');
    Route::get('user', function () {
        return auth()->user();
    });

    // Admins
    Route::middleware('can:create,App\Admin')->group(function (){
        Route::get('admins', 'AdminController@index')->name('admin.admins.index');
        Route::post('admins', 'AdminController@store')->name('admin.admins.store');
        Route::put('admins/{admin}', 'AdminController@update')->name('admin.admins.update');
        Route::delete('admins/{admin}', 'AdminController@destroy')->name('admin.admins.destroy');
    });

    // Locations
    Route::get('locations', 'LocationController@index')->name('admin.locations.index')->middleware('can:create,App\Location');
    Route::post('locations', 'LocationController@store')->name('admin.locations.store')->middleware('can:create,App\Location');
    Route::put('locations/{location}', 'LocationController@update')->name('admin.locations.update')->middleware('can:update,App\Location');
    Route::delete('locations/{location}', 'LocationController@destroy')->name('admin.locations.destroy')->middleware('can:delete,App\Location');

    // Property Types
    Route::get('property-types', 'PropertyTypeController@index')->name('admin.propertyTypes.index')->middleware('can:create,App\PropertyType');
    Route::post('property-types', 'PropertyTypeController@store')->name('admin.propertyTypes.store')->middleware('can:create,App\PropertyType');
    Route::put('property-types/{propertyType}', 'PropertyTypeController@update')->name('admin.propertyTypes.update')->middleware('can:update,App\PropertyType');
    Route::delete('property-types/{propertyType}', 'PropertyTypeController@destroy')->name('admin.propertyTypes.destroy')->middleware('can:delete,App\PropertyType');

    // Developers
    Route::get('developers', 'DeveloperController@index')->name('admin.developers.index')->middleware('can:create,App\Developer');
    Route::post('developers', 'DeveloperController@store')->name('admin.developers.store')->middleware('can:create,App\Developer');
    Route::post('developers/{developer}', 'DeveloperController@update')->name('admin.developers.update')->middleware('can:update,App\Developer');
    Route::delete('developers/{developer}', 'DeveloperController@destroy')->name('admin.developers.destroy')->middleware('can:delete,App\Developer');

    // Departments
    Route::get('departments', 'DepartmentController@index')->name('admin.departments.index')->middleware('can:create,App\Department');
    Route::post('departments', 'DepartmentController@store')->name('admin.departments.store')->middleware('can:create,App\Department');
    Route::put('departments/{department}', 'DepartmentController@update')->name('admin.departments.update')->middleware('can:update,App\Department');
    Route::delete('departments/{department}', 'DepartmentController@destroy')->name('admin.departments.destroy')->middleware('can:delete,App\Department');

    // Projects
    Route::get('projects', 'ProjectController@index')->name('admin.projects.index');
    Route::get('projects/create', 'ProjectController@create')->name('admin.projects.create')->middleware('can:create,App\Project');
    Route::post('projects', 'ProjectController@store')->name('admin.projects.store')->middleware('can:create,App\Project');
    Route::get('projects/{project}/edit', 'ProjectController@edit')->name('admin.projects.edit');
    Route::post('projects/{project}', 'ProjectController@update')->name('admin.projects.update')->middleware('can:update,App\Project');
    Route::delete('projects/{project}', 'ProjectController@destroy')->name('admin.projects.destroy')->middleware('can:delete,App\Project');

    // Citizenship
    Route::get('citizenship', 'CitizenshipController@index')->name('admin.citizenship.index');
    Route::get('citizenship/create', 'CitizenshipController@create')->name('admin.citizenship.create')->middleware('can:create,App\Citizenship');
    Route::post('citizenship', 'CitizenshipController@store')->name('admin.citizenship.store')->middleware('can:create,App\Citizenship');
    Route::get('citizenship/{citizenship}/edit', 'CitizenshipController@edit')->name('admin.citizenship.edit');
    Route::post('citizenship/{citizenship}', 'CitizenshipController@update')->name('admin.citizenship.update')->middleware('can:update,App\Citizenship');
    Route::delete('citizenship/{citizenship}', 'CitizenshipController@destroy')->name('admin.citizenship.destroy')->middleware('can:delete,App\Citizenship');

    // Tags
    Route::get('tags', 'TagController@index')->name('admin.tags.index')->middleware('can:create,App\Tag');
    Route::post('tags', 'TagController@store')->name('admin.tags.store')->middleware('can:create,App\Tag');
    Route::put('tags/{tag}', 'TagController@update')->name('admin.tags.update')->middleware('can:update,App\Tag');
    Route::delete('tags/{tag}', 'TagController@destroy')->name('admin.tags.destroy')->middleware('can:delete,App\Tag');

    // Posts
    Route::get('posts', 'PostController@index')->name('admin.posts.index');
    Route::get('posts/create', 'PostController@create')->name('admin.posts.create')->middleware('can:create,App\Post');
    Route::post('posts', 'PostController@store')->name('admin.posts.store')->middleware('can:create,App\Post');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('admin.posts.edit');
    Route::post('posts/{post}', 'PostController@update')->name('admin.posts.update')->middleware('can:update,App\Post');
    Route::post('posts/{post}/publish', 'PostController@togglePublish')->name('admin.posts.togglePublish')->middleware('can:create,App\Post');
    Route::delete('posts/{post}', 'PostController@destroy')->name('admin.posts.destroy')->middleware('can:delete,App\Post');

    // Pages
    Route::get('pages', 'PageController@index')->name('admin.pages.index');
    Route::get('pages/create', 'PageController@create')->name('admin.pages.create')->middleware('can:create,App\Page');
    Route::post('pages', 'PageController@store')->name('admin.pages.store')->middleware('can:create,App\Page');
    Route::get('pages/{page}/edit', 'PageController@edit')->name('admin.pages.edit');
    Route::post('pages/{page}', 'PageController@update')->name('admin.pages.update')->middleware('can:update,App\Page');
    Route::post('pages/{page}/publish', 'PageController@togglePublish')->name('admin.pages.togglePublish')->middleware('can:create,App\Page');
    Route::delete('pages/{page}', 'PageController@destroy')->name('admin.pages.destroy')->middleware('can:delete,App\Page');

    // Sliders
    Route::get('sliders', 'SliderController@index')->name('admin.sliders.index')->middleware('can:create,App\Slider');
    Route::get('sliders/{slider}/edit', 'SliderController@edit')->name('admin.sliders.edit')->middleware('can:create,App\Slider');
    Route::post('sliders', 'SliderController@store')->name('admin.sliders.store')->middleware('can:create,App\Slider');
    Route::post('sliders/{slider}/main', 'SliderController@toggleMain')->name('admin.sliders.toggleMain')->middleware('can:create,App\Slider');
    Route::post('sliders/{slider}/images', 'SliderController@addSlide')->name('admin.sliders.addSlide')->middleware('can:create,App\Slider');
    Route::post('sliders/{slider}/images/{sliderImage}', 'SliderController@updateSlide')->name('admin.sliders.updateSlide')->middleware('can:create,App\Slider');
    Route::delete('sliders/{slider}/images/{sliderImage}', 'SliderController@removeSlide')->name('admin.sliders.removeSlide')->middleware('can:create,App\Slider');
    Route::put('sliders/{slider}', 'SliderController@update')->name('admin.sliders.update')->middleware('can:update,App\Slider');
    Route::delete('sliders/{slider}', 'SliderController@destroy')->name('admin.sliders.destroy')->middleware('can:delete,App\Slider');
});

/******************** Public Area ************************/

// Projects
Route::get('/projects/{projectType}/{project}', 'ProjectController@show');
Route::get('/projects/{projectType}', 'ProjectController@index')->name('projects.index');

// Developers
Route::get('/developers', 'DeveloperController@index')->name('developers.index');
Route::get('/developers/{developer}', 'DeveloperController@show')->name('developers.show');

// Pages
Route::get('/p/{page}', 'PageController@show')->name('pages.show');

// Citizenship & Residency
Route::get('/countries/{type}/{citizenship}', 'CitizenshipController@show');