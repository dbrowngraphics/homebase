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

Route::get('/', function () {
    return view('homepage');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/forgotpassword', function() {
	return view('forgotpassword');
})->name('forgotpassword');

// Need to figure out a better solution
Route::get('/logout', function() {
	dd("Logout!");
});

Route::get('home/logout', function() {
	dd("Logout!");
});

Route::get('/master', function () {
    // return view('welcome');
    return view('temp');
});

//Preclaim
// Route::get('/preclaim', function () {
//     return view('preclaim.master');
// }); // ->middleware('auth')

Route::get('/preclaim', 'PreclaimController@index');
Route::post('/preclaim/search', 'PreclaimController@search')->name('search');
// Route::get('/preclaim/search', 'PreclaimController@search')->name('search');


Route::get('/preclaim/single/{batch_id}/{item_id}', [
	'uses' => 'PreclaimController@singleClaim',
	'as' => 'single'
]);
Route::get('/preclaim/singleview', 'PreclaimController@singleview')->name('singleview');



Route::resource('/web-node', 'WebDocsController');
Route::get('/web-node/form', 'WebDocsController@form')->name('web-node.form');

// Route::get('/web-node', 'WebDocsController@index');
Route::post('/web-node/getNode', ['as' => 'getNode', 'uses' => 'WebDocsController@nodeFilter']);
Route::post('webdocssave', 'WebDocsController@store')->name('WebDocs.save');
// Route::post('webdocsupdate/{id}', 'WebDocsController@update')->name('WebDocs.updater');
Route::patch('/web-node/{node}/{id}', 'WebDocsController@update')->name('WebDocs.update');


/*
 * Stoploss Claims Routes
 */
Route::get('/stoplossclaims', 'StopLossClaimsController@index');
Route::post('/stoplossclaims', 'StopLossClaimsController@formSubmit')->name('stoploss');
Route::post('/stoplosscliams/changeStatus', 'StopLossClaimsController@changeStatus')->name('stoplosschanges');
