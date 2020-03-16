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

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');
Route::prefix('laratables')->group(function ()
{
  Route::get('minimum', 'HomeController@laratables')->name('laratables.minimum');
});
Route::prefix('fetch')->group(function ()
{
  Route::prefix('entries')->group(function ()
  {
    Route::get('code', 'EntriesController@fetchCode')->name('fetch.entries.code');
    Route::get('description', 'EntriesController@fetchDescription')->name('fetch.entries.description');
  });
});
Route::resources([
  'entradas'    => 'EntriesController',
  'salidas'     => 'ExitsController',
  'categorias'  => 'CategoriesController',
  'inventario'  => 'InventoryController',
  'reportes'    => 'ReportsController',
  'empleados'   => 'EmployeesController',
  'proveedores' => 'ProvidersController',
  'reparaciones'=> 'RepairsController',
]);
