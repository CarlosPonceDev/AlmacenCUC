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

Route::get('/', 'DashboardController@index')->name('dashboard');
Route::prefix('laratables')->group(function ()
{
  Route::get('minimum', 'DashboardController@laratables')->name('laratables.minimum');
});
Route::prefix('fetch')->group(function ()
{
  Route::prefix('products')->group(function ()
  {
    Route::get('code', 'FetchsController@code')->name('fetch.code');
    Route::get('description', 'FetchsController@description')->name('fetch.description');
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
