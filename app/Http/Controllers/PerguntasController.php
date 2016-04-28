<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 25/04/2016
 * Time: 09:34
 */
use adsproject\Pergunta;
use adsproject\Http\Requests\PerguntaRequest;

class PerguntasController extends Controller{

    public function index(){
        $perguntas = Pergunta::all();
        return view('perguntas.index', ['perguntas'=>$perguntas]);
    }
    public function novo(){
        return view('perguntas.novo');
    }
    public function salvar(PerguntaRequest $request){
        $pergunta = $request->all();
        Pergunta::create($pergunta);
        return redirect()->route('perguntas');
    }
    public function editar($id){
        $pergunta = Pergunta::find($id);
        return view('perguntas.editar', compact('pergunta'));
    }
    public function alterar(PerguntaRequest $request, $id){
        Pergunta::find($id)->update($request->all());
        return redirect('perguntas');
    }
    public function excluir($id){
        Pergunta::find($id)->delete();
        return redirect()->route('perguntas');
    }
}