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
  //1St parameter:uri=>sub of url , 2nd parameter:action=>function that will be executed when go to the path /
  //closure function or callback function
    return view('welcome');//execute welcome.blade.php file
    //view:global helper method=>make load for welcome.blade.php view , takes just name of view
  // return 'monica'; 
});


Route::get('/test', function () {
    $allNames=['monica', 'ashraf' , 'refaat'];
    return view('test',[
        'names' => $allNames,
    ]);//1st parameter:"view",2nd parameter "data" :array[] ---> ('key' of foreach in view => value variable name of array)
 });
