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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

// Llamamos a los controladores que vamos a utilizar
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Auth::routes();

// Al parecer es más facil llamar a los controllers directamente
// El cambio de laravel 5 al 9 tienen muchos cambios.
Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('home');



/////////////////////////////////////////////////////////////
//
//             SEARCH
//
//////////////////////////////////////////////////////////////

//------------- SEARCH GROUP------------------------------------------
Route::get('search/{group?}',[
  'as' => 'groupSearch',
  // Le indico el controlador y la accion a ejecutear
  'uses' => 'App\Http\Controllers\OrderController@search'
]);


Route::any('submit/{journal?}/{book?}/{database?}',[
  'as' => 'submit',
  // Le indico el controlador y la accion a ejecutear
  'uses' => 'App\Http\Controllers\OrderController@submit'
]);


/////////////////////////////////////////////////////////////
//
//                JOURNAL SELECTION
//
//
//////////////////////////////////////////////////////////////
//------------- SELECTED ORDERS------------------------------------------
// Aqui le puse SEARCHES a la ruta para que no se confunda con la de groups
//NO puedo usar la misma porque sino se confunde la inforacion que paso.

//-----------       1     --------------------------------
Route::any('journals',[
  'as' => 'journalSelection',
  // Le indico el controlador y la accion a ejecutear
  'uses' => 'JournalController@selectJournal'
]);

Route::any('books',[
  'as' => 'bookSelection',
  // Le indico el controlador y la accion a ejecutear
  'uses' => 'BookController@selectBook'
]);

Route::any('db',[
  'as' => 'dbSelection',
  // Le indico el controlador y la accion a ejecutear
  'uses' => 'DbController@selectDB'
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');












//Route::get('/register','Auth\AuthController@register');
//Route::post('/register','Auth\AuthController@postRegister')->name('register');

//Route::get('/login','AuthController@login');
//Route::post('/login','AuthController@postLogin')->name('login');


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
