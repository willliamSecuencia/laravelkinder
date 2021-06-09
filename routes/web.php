<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
    if (Auth::check()) {
        return view('home');
    }
    return view('auth.login');
})->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas Contacto - Docentes - Teacher
Route::prefix('/contacto')->group(function () {
    Route::get('/', 'Contacto\ContactoController@index')->name('contacts.index');
    Route::get('/add/{id}', 'Contacto\ContactoController@add')->name('contacts.add');
    Route::post('/', 'Contacto\ContactoController@store')->name('contacts.store');
    Route::delete('/{id}', 'Contacto\ContactoController@delete')->name('contacts.delete');
});

//Rutas Estudiantes
Route::prefix('estudiante')->group(function () {
    Route::get('/', 'Estudiante\EstudianteController@index')->name('students.index');
    Route::get('/add/{id}', 'Estudiante\EstudianteController@add')->name('students.add');
    Route::post('/', 'Estudiante\EstudianteController@store')->name('students.store');
    Route::delete('/{id}', 'Estudiante\EstudianteController@delete')->name('students.delete');
});

//Rutas Criterios
Route::prefix('criterio')->group(function () {
    Route::get('/', 'Criterio\CriterioController@index')->name('criterio.index');
    Route::get('/list/{id}', 'Criterio\CriterioController@listcn')->name('criterio.listacriterio');
    Route::get('/add/{id}/{idn}', 'Criterio\CriterioController@add')->name('criterio.add');
    Route::post('/', 'Criterio\CriterioController@store')->name('criterio.store');
    Route::delete('/{id}', 'Criterio\CriterioController@delete')->name('criterio.delete');
});

//Rutas Items de los Criterios
Route::prefix('itemcriterio')->group(function () {
    Route::get('/', 'ItemCriterio\ItemCriterioController@index')->name('itemcriterio.index');
    Route::get('/list/{id}', 'ItemCriterio\ItemCriterioController@listitmcr')->name('itemcriterio.listitem');
    Route::get('/add/{id}/{idct}', 'ItemCriterio\ItemCriterioController@add')->name('itemcriterio.add');
    Route::post('/', 'ItemCriterio\ItemCriterioController@store')->name('itemcriterio.store');
    Route::delete('/{id}', 'ItemCriterio\ItemCriterioController@delete')->name('itemcriterio.delete');
});

//Usuario por perfil
Route::prefix('perfil')->group(function () {
    Route::get('/', 'PerfilesUsuario\PerfilesUsuarioController@index')->name('userprofiles.index');
    Route::get('/add/{id}', 'PerfilesUsuario\PerfilesUsuarioController@add')->name('userprofiles.add');
    Route::post('/', 'PerfilesUsuario\PerfilesUsuarioController@store')->name('userprofiles.store');
    Route::delete('/{id}', 'PerfilesUsuario\PerfilesUsuarioController@delete')->name('userprofiles.delete');
});

//Rutas Estudiantes evaluacion
Route::prefix('evaluacionestudiante')->group(function () {
    Route::get('/', 'EstudianteEvaluacion\EstudianteEvaluacionController@index')->name('studentsquiz.index');
    Route::get('/add/{id}', 'EstudianteEvaluacion\EstudianteEvaluacionController@add')->name('studentsquiz.add');
    Route::post('/', 'EstudianteEvaluacion\EstudianteEvaluacionController@store')->name('studentsquiz.store');
    Route::delete('/{id}', 'EstudianteEvaluacion\EstudianteEvaluacionController@delete')->name('studentsquiz.delete');
});
