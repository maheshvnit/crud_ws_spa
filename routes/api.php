<?php

use Illuminate\Http\Request;

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


Route::post('/post/create', 'PostController@store');
Route::get('/post/edit/{id}', 'PostController@edit');
Route::post('/post/update/{id}', 'PostController@update');
Route::delete('/post/delete/{id}', 'PostController@delete');
Route::get('/posts', 'PostController@index');

// Actions Handled By Resource Controller

    /*
        Actions Handled By Resource Controller

        Verb	    URI	                    Action	Route Name

        GET	        /photos	                index	photos.index
        GET	        /photos/create	        create	photos.create
        POST	    /photos	                store	photos.store
        GET	        /photos/{photo}	        show	photos.show
        GET	        /photos/{photo}/edit	edit	photos.edit
        PUT/PATCH	/photos/{photo}	        update	photos.update
        DELETE	    /photos/{photo}	        destroy	photos.destroy

    */

// Personal Access Tokens    
// https://laravel.com/docs/5.8/passport#personal-access-tokens
// https://laravel.com/docs/5.8/passport#protecting-routes    

//Route::middleware(['auth:api'])->namespace('API\V1')->prefix('v1')->group(function()  // working
Route::middleware(['auth:api'])->namespace('API')->group(function()  // working
{
    Route::resource('user', 'ClientuserController');

});

// client : Client Credentials Grant Tokens
// 'grant_type' => 'client_credentials',
// https://laravel.com/docs/5.8/passport#client-credentials-grant-tokens
// The client credentials grant is suitable for machine-to-machine authentication. 
// For example, you might use this grant in a scheduled job which is performing maintenance tasks over an API.

Route::middleware(['client'])->namespace('API')->group(function()  // working
{
    Route::resource('user', 'ClientuserController');

});

