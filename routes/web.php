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
$router->get('/team/{id}','TeamController@show');  
 
 

//turnamen
$router->get('/turnamen','TurnamenController@index');
 
$router->get('/turnamen/{id}','TurnamenController@show');  
 


//pertandingan
$router->get('/pertandingan','PertandinganController@index');
 
$router->get('/pertandingan/{id}','PertandinganController@show');  
 


//klasemen
$router->get('/klasemen','KlasemenController@index');
  
$router->get('/klasemen/{id}','KlasemenController@show');  


//wasit
$router->get('/wasit','WasitController@index');
  
$router->get('/wasit/{id}','WasitController@show');  



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
    $router->post('/team','TeamController@store');
    $router->put('/team/{id}','TeamController@update');
    $router->delete('/team/{id}','TeamController@delete');
    $router->post('/turnamen','TurnamenController@store'); 
    $router->put('/turnamen/{id}','TurnamenController@update');
    $router->delete('/turnamen/{id}','TurnamenController@delete');
    $router->post('/pertandingan','PertandinganController@store'); 
    $router->put('/pertandingan/{id}','PertandinganController@update');
    $router->delete('/pertandingan/{id}','PertandinganController@delete');
    $router->post('/klasemen','KlasemenController@store');
    $router->put('/klasemen/{id}','KlasemenController@update'); 
    $router->delete('/klasemen/{id}','KlasemenController@delete');
    $router->post('/wasit','WasitController@store');
    $router->put('/wasit/{id}','WasitController@update'); 
    $router->delete('/wasit/{id}','WasitController@delete');
});