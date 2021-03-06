<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 15/03/2016
 * Time: 09:00
 */
use adsproject\Professor;
use adsproject\Http\Requests\ProfessorRequest;

/**Classe controller de professores
 * Class ProfessoresController
 * @package adsproject\Http\Controllers
 */
class ProfessoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**Método que redireciona para página inicial de professores
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $professores = Professor::orderBy('nome')
            ->paginate(config('constantes.paginacao'));                     //Busca professores ordenando por nome
        return view('professores.index', ['professores' => $professores]);  //Redireciona à página inicial de professores
    }

    /**Método que redireciona para página de inclusão de novo professor
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('professores.novo');                                    //Redireciona a página de inclusão de professor
    }

    /**Método que inclui novo professor no sistema
     * @param ProfessorRequest $request relação de dados do professor a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(ProfessorRequest $request)
    {
        $this->validate($request,
            ['matricula' => 'unique:professors,matricula']);                //Valida matrícula do professor
        Professor::create($request->all());                                 //Cria novo professor
        return redirect()->route('professores');                            //Redireciona para página inicial de professores
    }

    /**Método que redireciona para página de edição de professor
     * @param $id int identificador do professor a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $professor = Professor::find($id);                                  //Busca professor pelo id
        return view('professores.editar', compact('professor'));            //Redireciona à página de edição de professor
    }

    /**Método que realiza alteração de dados de professor
     * @param ProfessorRequest $request relação de dados do professor a ser alterado
     * @param $id int identificador do aluno a ser alterado
     * @return \Illuminate\Http\RedirectResponse
     */
    public function alterar(ProfessorRequest $request, $id)
    {
        $this->validate($request,
            ['matricula' => 'unique:professors,matricula,' . $id]);         //Valida matrícula de professor
        Professor::find($id)->update($request->all());                      //Atualiza dados do professor
        return redirect()->route('professores');                            //Redireciona à página inicial de professores
    }

    /**Método que exclui professor
     * @param $id int identificador do professor a ser excluído
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Professor::find($id)->delete();                                     //Busca professor por id e exclui
        return redirect()->route('professores');                            //Redireciona à página inicial de professores
    }
}