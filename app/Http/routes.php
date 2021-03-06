<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('home', function () {
    return redirect('/');
});

//Rotas de Alunos
Route::group(['prefix' => 'alunos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAluno
    Route::get('', ['middleware' => 'check.user.role:admin,professor', 'as' => 'alunos', 'uses' => 'AlunosController@index']);
//Rota para novo aluno
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.novo', 'uses' => 'AlunosController@novo']);
//Rota para salvar aluno
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.salvar', 'uses' => 'AlunosController@salvar']);
//Rota para excluir aluno
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.excluir', 'uses' => 'AlunosController@excluir']);
//Rota para editar aluno
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.editar', 'uses' => 'AlunosController@editar']);
//Rota para alterar aluno
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.alterar', 'uses' => 'AlunosController@alterar']);
//Rota para view de arquivo de alunos
    Route::get('arquivo', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.arquivo', 'uses' => 'AlunosController@arquivo']);
//Rota para carregar dados de alunos no banco de dados via arquivo
    Route::post('carregar', ['middleware' => 'check.user.role:admin', 'as' => 'alunos.carregar', 'uses' => 'AlunosController@carregar']);
});

//Rotas de professores
Route::group(['prefix' => 'professores', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexProfessor
    Route::get('', ['as' => 'professores', 'uses' => 'ProfessoresController@index']);
    //Route::get('professores', ['as'=>'professores', 'uses' =>'ProfessoresController@index']);
//Rota para novo professor
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'professores.novo', 'uses' => 'ProfessoresController@novo']);
//Rota para salvar professor
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'professores.salvar', 'uses' => 'ProfessoresController@salvar']);
//Rota para exluir professor
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'professores.excluir', 'uses' => 'ProfessoresController@excluir']);
//Rota para ediçaoo de professor
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'professores.editar', 'uses' => 'ProfessoresController@editar']);
//Rota para alteraçao de professor
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'professores.alterar', 'uses' => 'ProfessoresController@alterar']);
});
//Rotas de disciplinas
Route::group(['prefix' => 'disciplinas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexDisciplina
    Route::get('', ['as' => 'disciplinas', 'uses' => 'DisciplinasController@index']);
//Rota para nova disciplina
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.novo', 'uses' => 'DisciplinasController@novo']);
//Rota para salvar disciplina
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.salvar', 'uses' => 'DisciplinasController@salvar']);
//Rota para exluir disciplina
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.excluir', 'uses' => 'DisciplinasController@excluir']);
//Rota para editar disciplina
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.editar', 'uses' => 'DisciplinasController@editar']);
//Rota para alterar disciplina
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'disciplinas.alterar', 'uses' => 'DisciplinasController@alterar']);
//Rota para abrir arquivo de ementa
//    Route::get('{id}/ementa', ['as' => 'disciplinas.ementa', 'uses' => 'DisciplinasController@ementa']);
//Rota para abrir arquivo de plano de ensino
//    Route::get('{id}/planoEnsino', ['as' => 'disciplinas.planoEnsino', 'uses' => 'DisciplinasController@planoEnsino']);
});
//Rotas de documentos
Route::group(['prefix' => 'documentos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexDocumentos
    Route::get('', ['as' => 'documentos', 'uses' => 'DocumentosController@index']);
//Rota para novo documento
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.novo', 'uses' => 'DocumentosController@novo']);
//Rota para salvar documento
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.salvar', 'uses' => 'DocumentosController@salvar']);
//Rota para exluir documento
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.excluir', 'uses' => 'DocumentosController@excluir']);
//Rota para editar documento
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.editar', 'uses' => 'DocumentosController@editar']);
//Rota para alterar documento
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'documentos.alterar', 'uses' => 'DocumentosController@alterar']);
    //Rota para abrir arquivo de documento
//    Route::get('{id}/arquivo', ['as' => 'documentos.arquivo', 'uses' => 'DocumentosController@arquivo']);
});

//Rotas de semestres
Route::group(['prefix' => 'semestres', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexSemestre
    Route::get('', ['as' => 'semestres', 'uses' => 'SemestresController@index']);
//Rota para novo semestre
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.novo', 'uses' => 'SemestresController@novo']);
//Rota para salvar semestre
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.salvar', 'uses' => 'SemestresController@salvar']);
//Rota para exluir semestre
    //Route::get('{codigo}/excluir',['middleware'=>'check.user.role:admin','as'=>'Semestres.excluir', 'uses'=> 'SemestresController@excluir']);
//Rota para editar semestre
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.editar', 'uses' => 'SemestresController@editar']);
//Rota para alterar semestre
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'semestres.alterar', 'uses' => 'SemestresController@alterar']);
});
//Rotas de avaliações
Route::group(['prefix' => 'avaliacoes', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAvaliacao
    Route::get('', ['as' => 'avaliacoes', 'uses' => 'AvaliacoesController@index']);
//Rota para nova avaliacao
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.novo', 'uses' => 'AvaliacoesController@novo']);
//Rota para salvar avaliacao
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.salvar', 'uses' => 'AvaliacoesController@salvar']);
//Rota para exluir avaliacao
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.excluir', 'uses' => 'AvaliacoesController@excluir']);
//Rota para editar avaliacao
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.editar', 'uses' => 'AvaliacoesController@editar']);
//Rota para alterar avaliacao
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'avaliacoes.alterar', 'uses' => 'AvaliacoesController@alterar']);
    //Rota para emitir relatório de avaliacao
    Route::get('{id}/relatorio', ['middleware' => 'check.user.role:admin,professor', 'as' => 'avaliacoes.relatorio', 'uses' => 'AvaliacoesController@emitirRelatorio']);
});
//Rotas de avisos
Route::group(['prefix' => 'avisos', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexAviso
    Route::get('', ['as' => 'avisos', 'uses' => 'AvisosController@index']);
//Rota para nova aviso
    Route::get('novo', ['middleware' => 'check.user.role:admin,professor', 'as' => 'avisos.novo', 'uses' => 'AvisosController@novo']);
//Rota para salvar aviso
    Route::post('salvar', ['middleware' => 'check.user.role:admin,professor', 'as' => 'avisos.salvar', 'uses' => 'AvisosController@salvar']);
//Rota para exluir aviso
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'avisos.excluir', 'uses' => 'AvisosController@excluir']);
//Rota para editar aviso
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'avisos.editar', 'uses' => 'AvisosController@editar']);
//Rota para alterar aviso
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'avisos.alterar', 'uses' => 'AvisosController@alterar']);
});

//Rotas de perguntas
Route::group(['prefix' => 'perguntas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexPergunta
    Route::get('', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas', 'uses' => 'PerguntasController@index']);
//Rota para nova pergunta
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.novo', 'uses' => 'PerguntasController@novo']);
//Rota para salvar pergunta
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.salvar', 'uses' => 'PerguntasController@salvar']);
//Rota para exluir pergunta
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.excluir', 'uses' => 'PerguntasController@excluir']);
//Rota para editar pergunta
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.editar', 'uses' => 'PerguntasController@editar']);
//Rota para alterar pergunta
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'perguntas.alterar', 'uses' => 'PerguntasController@alterar']);
});
//Rotas de respostas
Route::group(['prefix' => 'respostas', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexResposta
    Route::get('', ['middleware' => 'check.user.role:admin', 'as' => 'respostas', 'uses' => 'RespostasController@index']);
});
//Rotas de users
Route::group(['prefix' => 'users', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexUser
    Route::get('', ['as' => 'users', 'uses' => 'UsersController@index']);
//Rota para novo user
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'users.novo', 'uses' => 'UsersController@novo']);
//Rota para salvar user
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'users.salvar', 'uses' => 'UsersController@salvar']);
//Rota para exluir user
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'users.excluir', 'uses' => 'UsersController@excluir']);
//Rota para editar user
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'users.editar', 'uses' => 'UsersController@editar']);
//Rota para alterar user
    Route::put('{id}/alterar', ['as' => 'users.alterar', 'uses' => 'UsersController@alterar']);
});
//Rotas de enads
Route::group(['prefix' => 'enades', 'where' => ['id' => '[0-9]+']], function () {
//Rota para IndexEnade
    Route::get('', ['as' => 'enades', 'uses' => 'EnadesController@index']);
//Rota para novo enade
    Route::get('novo', ['middleware' => 'check.user.role:admin', 'as' => 'enades.novo', 'uses' => 'EnadesController@novo']);
//Rota para salvar enade
    Route::post('salvar', ['middleware' => 'check.user.role:admin', 'as' => 'enades.salvar', 'uses' => 'EnadesController@salvar']);
//Rota para exluir enade
    Route::get('{id}/excluir', ['middleware' => 'check.user.role:admin', 'as' => 'enades.excluir', 'uses' => 'EnadesController@excluir']);
//Rota para editar enade
    Route::get('{id}/editar', ['middleware' => 'check.user.role:admin', 'as' => 'enades.editar', 'uses' => 'EnadesController@editar']);
//Rota para alterar enade
    Route::put('{id}/alterar', ['middleware' => 'check.user.role:admin', 'as' => 'enades.alterar', 'uses' => 'EnadesController@alterar']);
});

//Testando push notification
Route::get('push', ['uses' => 'PushNotificationController@sendNotificationToDevice']);

// TokenController / TokenController
Route::post('token', ['as' => 'token', 'uses' => 'TokenController@salvarToken']);

//Rotas do questionário de avaliação
Route::group(['prefix' => 'questionarios'], function () {
    //Rota para resposta de questionário (inicial)
    Route::get('', ['as' => 'questionarios', 'uses' => 'QuestionariosController@novo']);
    //Rota para salvar o questionário (depois de respondido)
    Route::post('salvar', ['as' => 'questionarios.salvar', 'uses' => 'QuestionariosController@salvar']);
});

//Rotas de autenticação
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'sair', 'uses' => 'Auth\AuthController@getLogout']);
//Rotas de registro
Route::get('auth/register', ['as' => 'registro', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'registrar', 'uses' => 'Auth\AuthController@postRegister']);

//Rotas para solicitar troca de senha
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
//Rotas para trocar senha
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@postReset']);


/*
// Verifica se o usuário está logado
Route::group(array('before' => 'auth'), function()
{
        // Rota de artigos
    Route::controller('artigos', 'ArtigosController');

    // Rotas do administrador
    Route::group(array('before' => 'auth.admin'), function()
    {
        Route::controller('usuarios', 'UsuariosController');
    });
});*/


/*
 * Rotas para API desenvolvida com a Library Dingo, usando o JWT-Auth para autenticação
 * através da troca de tokens entre usuário e recursos do sistema
 *
 * */

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'adsproject\Http\Controllers\Api'], function ($api) {
        $api->post('login', 'ApiController@authenticate');
        $api->post('logout', 'ApiController@logout');

        $api->get('avisos', 'ApiController@avisosAll');
        $api->get('documentos', 'ApiController@documentosAll');
        $api->get('professores', 'ApiController@professoresAll');
        $api->get('disciplinas', 'ApiController@disciplinasAll');
        $api->get('avaliacoes', 'ApiController@avaliacoesAll');
        $api->get('questionarios', 'ApiController@questionariosAll');
        $api->get('questionariosSalvar', 'ApiController@questionariosSalvar');
        $api->post('informacaoUser', 'ApiController@informacaoUser');
        $api->post('disciplinasCursadas', 'ApiController@buscaDisciplinasCursadas');
        $api->post('respostaQuestionario', 'ApiController@respostaQuestionario');
        $api->post('token', 'ApiController@tokenGCM');
    });
});