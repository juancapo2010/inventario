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

use App\Http\Controllers\PeoplesoftController;


Route::get('/create', function(){
    App\User::create([
        'name' => 'SomeName',
        'email' => 'some@mail',
        'password' => bcrypt('SomePassword'),
    ]);
 });


Route::get('/', function () {
    return view('auth.login');
});
// Auth
Auth::routes(['verify' => true]);
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');




Route::get('/home', 'HomeController@index')->name('home');
Route::get('/acerca.index', 'HomeController@acerca')->name('acerca');

Route::get('dashboard', function () {
   return view('layouts.master');
});

Route::get('dashboard', function () {
    return view('layouts.graficos');
 });



Route::group(['middleware' => 'auth'], function () {
    Route::resource('users','UserController');
    Route::get('user/{id}', 'UserController@show');
    Route::get('/apiUsers','UserController@apiUsers')->name('api.users');
    // Route::get('/', 'UserController@index')->name('user.index');
    Route::get('new', 'UserController@create')->name('user.new');
    Route::get('edit/{user}', 'UserController@edit')->name('user.edit');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::post('update/{id}', 'UserController@update')->name('user.update');
    Route::post('remove/{id}', 'UserController@destroy')->name('user.destroy');
    Route::get('user/password', 'UserController@password');
    Route::post('user/updatepassword/{user}', 'UserController@updatePassword');
    Route::post('user/updatepasswordAdmin', 'UserController@updatePasswordAdmin');
    
});


Route::group(['middleware' => 'auth'], function () {
    Route::resource('categories','CategoryController');
    Route::get('/apiCategories','CategoryController@apiCategories')->name('api.categories');
    Route::get('/exportCategoriesAll','CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
    Route::get('/exportCategoriesAllExcel','CategoryController@exportExcel')->name('exportExcel.categoriesAll');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('asignables','AsignableController');
    Route::get('/apiAsignables','AsignableController@apiAsignables')->name('api.asignables');
    Route::get('/asignables/{id}','AsignableController@show')->name('asignable.show');
    Route::post('/importAsignables','AsignableController@ImportExcel')->name('import.asignables');
    Route::get('/exportAsignablesAll','AsignableController@exportAsignablesAll')->name('exportPDF.asignablesAll');
    Route::get('/exportAsignablesAllExcel','AsignableController@exportExcel')->name('exportExcel.asignablesAll');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('sales','SaleController');
    Route::get('/apiSales','SaleController@apiSales')->name('api.sales');
    Route::post('/importSales','SaleController@ImportExcel')->name('import.sales');
    Route::get('/exportSalesAll','SaleController@exportSalesAll')->name('exportPDF.salesAll');
    Route::get('/exportSalesAllExcel','SaleController@exportExcel')->name('exportExcel.salesAll');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('estados','EstadoController');
    Route::get('/apiEstados','EstadoController@apiEstados')->name('api.estados');
    Route::post('/importEstados','EstadoController@ImportExcel')->name('import.estados');
    Route::get('/exportEstadossAll','EstadoController@exportEstadosAll')->name('exportPDF.estadosAll');
    Route::get('/exportEstadosAllExcel','EstadoController@exportExcel')->name('exportExcel.estadosAll');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('products','ProductController');
    Route::get('/apiProducts','ProductController@apiProducts')->name('api.products');
    Route::get('/filtro','ProductController@filtro')->name('api.filtro');
    // Route::post('/apiProductsShow/{id}','ProductController@apiProductsShow')->name('api.show');
    Route::get('/products/{id}','ProductController@show')->name('products.show');
    Route::get('/exportProductAll','ProductController@exportProductAll')->name('exportPDF.productAll');
    Route::get('/exportProductFiltro/{id}','ProductController@exportProductFiltro')->name('exportPDF.productFiltro');
    Route::get('/exportProductAllExcel','ProductController@exportExcel')->name('exportExcel.productAll');
    Route::get('/exportProduct/{id}','ProductController@exportProduct')->name('exportPDF.product');
    Route::post('/importExcel','ProductController@ImportExcel')->name('import.product');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('productsOut','ProductEntregaController');
    Route::get('/apiProductsOut','ProductEntregaController@apiProductsOut')->name('api.productsOut');
    Route::get('/exportProductEntregaAll','ProductEntregaController@exportProductEntregaAll')->name('exportPDF.productEntregaAll');
    Route::get('/exportProductEntregaAllExcel','ProductEntregaController@exportExcel')->name('exportExcel.productEntregaAll');
    Route::get('/exportProductEntrega/{id}','ProductEntregaController@exportProductEntrega')->name('exportPDF.productEntrega');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('productsIn','ProductDevolucionController');
    Route::get('/apiProductsIn','ProductDevolucionController@apiProductsIn')->name('api.productsIn');
    Route::get('/exportProductDevolucionAll','ProductDevolucionController@exportProductDevolucionAll')->name('exportPDF.productDevolucionAll');
    Route::get('/exportProductDevolucionAllExcel','ProductDevolucionController@exportExcel')->name('exportExcel.productDevolucionAll');
    Route::get('/exportProductDevolucion/{id}','ProductDevolucionController@exportProductDevolucion')->name('exportPDF.productDevolucion');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('auditorias','AuditController');
    Route::get('/apiAudits','AuditController@apiAudits')->name('api.audits');
    Route::get('audit/{id}', 'AuditController@show');
    // Route::get('/exportCategoriesAll','AuditController@exportCategoriesAll')->name('exportPDF.categoriesAll');
    // Route::get('/exportCategoriesAllExcel','AuditController@exportExcel')->name('exportExcel.categoriesAll');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('activos','ActivoController');
    Route::get('/apiActivos','ActivoController@apiActivos')->name('api.activos');
    Route::get('/activos/{id}','ActivoController@show')->name('activos.show');
    Route::post('/importActivos','ActivoController@ImportExcel')->name('import.activos');
    Route::get('/exportActivosAll','ActivoController@exportActivosAll')->name('exportPDF.activosAll');
    Route::get('/exportActivosAllExcel','ActivoController@exportExcel')->name('exportExcel.activosAll');
});


Route::get('/datos', 'PeoplesoftController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('mail', function () {
    return view('test');
}); //Esta ruta la ponemos en la raiz para que nada mas ejecutar nuestra aplicación aparezca nuestro formulario

Route::post('/contactar', 'EmailController@contact')->name('contact');
//Ruta que esta señalando nuestro formulario
