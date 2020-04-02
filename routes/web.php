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
  Route::get('inventory', 'InventoryController@laratables')->name('laratables.inventory');
  Route::get('category/{category}', 'CategoriesController@laratables')->name('laratables.categories');
  Route::get('employees', 'EmployeesController@laratables')->name('laratables.employees');
  Route::get('providers', 'ProvidersController@laratables')->name('laratables.providers');
  Route::get('repairs', 'RepairsController@laratables')->name('laratables.repairs');
  Route::get('entries', 'EntriesController@laratables')->name('laratables.entries');
  Route::get('exits', 'ExitsController@laratables')->name('laratables.exits');
});
Route::prefix('fetch')->group(function ()
{
  Route::get('code', 'FetchsController@code')->name('fetch.code');
  Route::get('product', 'FetchsController@product')->name('fetch.product');
  Route::get('employees', 'FetchsController@employees')->name('fetch.employees');
  Route::get('providers', 'FetchsController@providers')->name('fetch.providers');
  Route::get('observations', 'FetchsController@observations')->name('fetch.observations');
});
Route::prefix('reportes')->group(function ()
{
  Route::get('entradas', 'ReportsController@entries')->name('reports.entries');
  Route::get('exits', 'ReportsController@exits')->name('reports.exits');
});
Route::get('inventario/categoria/{category}', 'InventoryController@category')->name('inventario.category');
Route::post('reparacion/delivery', 'RepairsController@delivery')->name('reparacion.delivery');
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
