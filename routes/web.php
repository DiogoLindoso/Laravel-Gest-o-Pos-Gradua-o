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

Route::get('/', function () {
    return view('inicio');
});

Route::middleware(['auth'])->prefix('/home')->group( function(){
    Route::get('/',function(){
        $inscricao =auth()->user()->inscricao;
        return view('user/home',compact(['inscricao']));
    });
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
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/cotas', 'Admin\CotaController@index')->name('admin.cotas');
    Route::post('/cotas', 'Admin\CotaController@store')->name('cota.submit');
    Route::get('/cotas/edit/{cota}', 'Admin\CotaController@view')->name('cota.edit');
    Route::post('/cotas/edit/{cota}', 'Admin\CotaController@edit')->name('cota.edit.save');
    Route::get('/cotas/destroy/{cota}', 'Admin\CotaController@destroy')->name('cota.destroy');
    Route::get('/cursos', 'Admin\CursoController@index')->name('admin.cursos');
    Route::post('/cursos', 'Admin\CursoController@store')->name('curso.submit');
    Route::get('/cursos/edit/{curso}', 'Admin\CursoController@view')->name('curso.edit');
    Route::post('/cursos/edit/{curso}', 'Admin\CursoController@edit')->name('curso.edit.save');
    Route::get('/cursos/destroy/{curso}', 'Admin\CursoController@destroy')->name('curso.destroy');
    Route::get('/alunos', 'Admin\AlunoController@index')->name('admin.alunos');
    Route::get('/alunos/turma/{turma}', 'Admin\AlunoController@turma')->name('admin.turma.get');
    Route::get('/turmas', 'Admin\TurmaController@index')->name('admin.turmas');
    Route::post('/turmas','Admin\TurmaController@store')->name('admin.turmas.submit');
    Route::get('/turma/edit/{turma}', 'Admin\TurmaController@view')->name('admin.turma.edit');
    Route::post('/turma/edit/{turma}', 'Admin\TurmaController@edit')->name('admin.turma.edit.save');
    Route::get('/turma/destroy/{turma}','Admin\TurmaController@destroy')->name('admin.turma.destroy');
    Route::get('/municipios/{estado}', 'FilterSelectController@municipios')->name('estados.get');
    Route::get('/relatorio', 'Admin\RelatorioController@index')->name('admin.relatorio');
    Route::get('/relatorio/excel', 'ExportExcelController@excel')->name('admin.migracao');
});