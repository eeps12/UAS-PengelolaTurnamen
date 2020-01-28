<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


//pemain
$router->get('/pemain','PemainController@index'); 
$router->get('/pemain/{id}','PemainController@show');  

//team
$router->get('/team','TeamController@index');
$router->post('/team','TeamController@store');  
$router->get('/team/{id}','TeamController@show');  
$router->put('/team/{id}','TeamController@update'); 
$router->delete('/team/{id}','TeamController@delete'); 

//turnamen
$router->get('/turnamen','TurnamenController@index');
$router->post('/turnamen','TurnamenController@store');  
$router->get('/turnamen/{id}','TurnamenController@show');  
$router->put('/turnamen/{id}','TurnamenController@update'); 
$router->delete('/turnamen/{id}','TurnamenController@delete');

//pertandingan
$router->get('/pertandingan','PertandinganController@index');
$router->post('/pertandingan','PertandinganController@store');  
$router->get('/pertandingan/{id}','PertandinganController@show');  
$router->put('/pertandingan/{id}','PertandinganController@update'); 
$router->delete('/pertandingan/{id}','PertandinganController@delete');

//klasemen
$router->get('/klasemen','KlasemenController@index');
$router->post('/klasemen','KlasemenController@store');  
$router->get('/klasemen/{id}','KlasemenController@show');  
$router->put('/klasemen/{id}','KlasemenController@update'); 
$router->delete('/klasemen/{id}','KlasemenController@delete');

//wasit
$router->get('/wasit','WasitController@index');
$router->post('/wasit','WasitController@store');  
$router->get('/wasit/{id}','WasitController@show');  
$router->put('/wasit/{id}','WasitController@update'); 
$router->delete('/wasit/{id}','WasitController@delete');


 //authentication  
 $router->group(['prefix' => 'auth'], function () use ($router) {  
    // Matches "/api/register  
    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');  
});  

Route::group(['middleware' => ['auth']], function ($router) {
    $router->post('/pemain','PemainController@store'); 
    $router->put('/pemain/{id}','PemainController@update');
    $router->delete('/pemain/{id}','PemainController@delete'); 
});