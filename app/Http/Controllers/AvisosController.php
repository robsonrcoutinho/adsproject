<?php namespace adsproject\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 21/04/2016
 * Time: 11:12
 */
use adsproject\Aviso;
use adsproject\Http\Requests\AvisoRequest;

class AvisosController extends Controller{

    public function index(){
        $avisos = Aviso::all();
        return view('avisos.index', ['avisos'=>$avisos]);
    }
    public function novo(){
        return view('avisos.novo');
    }
    public function salvar(AvisoRequest $request){
        $aviso = $request->all();
        Aviso::create($aviso);
        return redirect()->route('avisos');
    }
    public function editar($id){
        $aviso = Aviso::find($id);
        return view('avisos.editar', compact('aviso'));
    }
    public function alterar(AvisoRequest $request, $id){
        Aviso::find($id)->update($request->all());
        return redirect('avisos');
    }
    public function excluir($id){
        Aviso::find($id)->delete();
        return redirect()->route('avisos');
    }
}