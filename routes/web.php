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

Route::view('/', 'inicio');

Route::middleware(['auth'])->prefix('/home')->group( function(){
    Route::view('/', 'user.home');
    Route::resource('documento', 'User\\DocumentoController')->only(['store','update', 'show'])->names('doc')->parameters(['documento'=>'user']);
    Route::resource('endereco', 'User\\EnderecoController')->only(['store','update','show'])->names('adress')->parameters(['endereco'=>'user']);
    Route::resource('inscricao', 'User\\InscricaoController')->only(['create','store','show'])->names('inscricao')->parameters(['inscricao'=>'user']);
    Route::get('/estados/{pais}', 'FilterSelectController@estados')->name('estados.get');
    Route::get('/municipios/{estado}', 'FilterSelectController@municipios')->name('municipios.get');
    Route::get('/municipiogetestado/{municipio}', 'FilterSelectController@municipioGetEstado')->name('municipioestado.get');
    Route::get('/estadogetpais/{estado}', 'FilterSelectController@estadoGetPais')->name('estadopais.get');
});

Route::get('admin/login', 'Auth\AdminLoginController@index')->name('admin.login');
Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::middleware(['auth:admin'])->prefix('/admin')->group( function () {
    Route::view('/', 'admin/admin')->name('admin.dashboard');
    Route::resource('/cotas', 'Admin\CotaController')->except(['show','create']);
    Route::resource('/cursos','Admin\CursoController')->except(['show','create']);
    Route::resource('/turmas','Admin\TurmaController')->except(['show','create']);
    Route::get('/alunos', 'Admin\AlunoController@index')->name('admin.alunos');
    Route::get('/alunos/turma/{turma}', 'Admin\AlunoController@turma')->name('admin.turma.get');

    Route::get('/municipios/{estado}', 'FilterSelectController@municipios')->name('estados.get');
    Route::get('/relatorio', 'Admin\RelatorioController@index')->name('admin.relatorio');
    Route::get('/relatorio/excel', 'ExportExcelController@excel')->name('admin.migracao');
});