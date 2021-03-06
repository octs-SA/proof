<?php

//use Illuminate\View\View;

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

// Home page
Route::get('/', 'PagesController@index')->name('home');

// About Page
Route::get('/about', 'PagesController@about')->name('about');

// Services
Route::get('/services', 'PagesController@services')->name('services');
Route::get('/service/{slug}', 'PagesController@service')->name('service.slug');

// Music
//Route::get('/tracks', 'MusicController@index')->name('tracks');
//Route::get('/tracks/{slug}', 'MusicController@show')->name('tracks.song');

// Videos
//Route::get('/vids','VideosController@videos')->name('vids');

// Artists
//Route::get('/artists', 'PagesController@artists')->name('artists');
//Route::get('/artists/{slug}', 'PagesController@artist')->name('artists.show');

Route::group(['prefix' => 'blog'], function() {
    Route::get('/', 'BlogController@index')->name('blog');
    Route::get('/{slug}','BlogController@singlePost')->name('blog.post')->where('slug', '[\w\d\-\_]+');
    Route::get('/category/{slug}', 'BlogController@postByCategory')->name('blog.category')->where('slug', '[\w\d\-\_]+');
    Route::get('/tag/{slug}', 'BlogController@postsByTag')->name('tag.post')->where('slug', '[\w\d\-\_]+');
});

Route::post('subscriber','SubscriberController@store')->name('subscriber.store');
Route::post('subscriber','SubscriberController@store')->name('subscriber.store');

//Route::get('/search','SearchController@search')->name('search');

//Route::get('profile/{username}','AuthorController@profile')->name('author.profile');



Route::get('/search','SearchController@search')->name('search');

// Contact
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact/mail', 'PagesController@mail')->name('contact.mail');

Auth::routes();

// Admin Panel routes

Route::get('/manage', 'HomeController@index')->name('manage');

Route::prefix('manage')->middleware('role:superadministrator|administrator|editor|author|contributor')->group(function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');

    // User Management
    Route::resource('users','Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    // User profile
    Route::get('profile', 'Admin\ProfileController@index')->name('profile');

    // Videos Management
    Route::resource('videos', 'Admin\VideosController');
    Route::post('videos_mass_destroy', ['uses' => 'Admin\VideosController@massDestroy', 'as' => 'videos.mass_destroy']);
    Route::post('videos_restore/{id}', ['uses' => 'Admin\VideosController@restore', 'as' => 'videos.restore']);
    Route::delete('videos_perma_del/{id}', ['uses' => 'Admin\VideosController@perma_del', 'as' => 'videos.perma_del']);

    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    // Posts Management
    Route::middleware('role:superadministrator|administrator|editor|author')->group(function () {
        Route::get('/', 'Admin\PostsController@redirect');
        Route::resource('posts', 'Admin\PostsController');
        Route::get('trashed-posts', 'Admin\PostsController@trashed')->name('trashed-posts.index');
        Route::get('/pending/post', 'Admin\PostsController@pending')->name('post.pending');
        Route::get('/post/{id}/approve', 'Admin\PostsController@approval')->name('post.approve');
        Route::put('restore-post/{post}', 'Admin\PostsController@restore')->name('post.restore');
    });

    // Categories
    Route::resource('category','Admin\CategoryController');

    // Tags
    Route::resource('tags', 'Admin\TagController');

    Route::get('/favourite', 'Admin\FavoriteController@index')->name('favourite.index');

    Route::get('authors', 'Admin\AuthorController@index')->name('author.index');
    Route::get('authors/{id}', 'Admin\AuthorController@destroy')->name('author.destroy');

    // Comments
    Route::get('comments','Admin\CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','Admin\CommentController@destroy')->name('comment.destroy');

    Route::get('/subscriber','Admin\SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','Admin\SubscriberController@destroy')->name('subscriber.destroy');

    // Music
    Route::resource('songs', 'Admin\SongController');
    Route::resource('songs/album-art', 'Admin\SongAvatarController');

    // Artists Management
    Route::resource('artist', 'Admin\ArtistsController');

    // Services
    Route::resource('solutions', 'Admin\ServicesController');

    // Settings
    Route::get('/settings', 'Admin\DashboardController@settings')->name('settings');
});

// Global Variables
view()->composer(['*'], function ($view) {
    $latestPosts = \App\Model\Post::latest()->limit(3)->get();
    $services = \App\Model\Service::all();

    $view->with(compact('latestPosts','services'));
});