<?php namespace adsproject\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Wilder
 * Date: 21/04/2016
 * Time: 11:12
 */
use adsproject\Aviso;
use adsproject\Http\Requests\AvisoRequest;
use PushNotification;






/**Classe controller de avisos
 * Class AvisosController
 * @package adsproject\Http\Controllers
 */
class AvisosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**MÃ©todo que redireciona para pÃ¡gina inicial de avisos
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->removerAntigos();                                    //Evoca mÃ©todo para remover avisos antigos
        $avisos = Aviso::orderBy('id', 'desc')
            ->paginate(config('constantes.paginacao'));             //Busca todos os avisos ordenando por id de forma decrescente
        return view('avisos.index', ['avisos' => $avisos]);         //Redireciona para pÃ¡gina inicial de avisos
    }

    /**MÃ©todo que redireciona para pÃ¡gina de inclusÃ£o de novo aviso
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function novo()
    {
        return view('avisos.novo');                             //Redireciona para pÃ¡gina de criaÃ§Ã£o de novo aviso
    }

    /**MÃ©todo que inclui novo aviso no sistema
     * @param AvisoRequest $request relaÃ§Ã£o de dados do aviso a ser inserido
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(AvisoRequest $request)
    {


        Aviso::create($request->all());                      //Cria novo aviso com dados passados

        $this->sendNotificationToDevice();

        return redirect()->route('avisos');                     //Redireciona para pÃ¡gina inicial de avisos
    }

    /**MÃ©todo que redireciona para pÃ¡gina de ediÃ§Ã£o de aviso
     * @param $id int identificador do aviso a ser editado
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $aviso = Aviso::find($id);                              //Busca aviso pelo id
        return view('avisos.editar', compact('aviso'));         //Redireciona para pÃ¡gina de ediÃ§Ã£o de aviso
    }

    /**MÃ©todo que realiza alteraÃ§Ã£o de dados de aviso
     * @param AvisoRequest $request relaÃ§Ã£o de dados do aviso a ser alterado
     * @param $id int identificador do aviso a ser alterado
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alterar(AvisoRequest $request, $id)
    {
        Aviso::find($id)->update($request->all());              //Busca aviso pelo id e atualiza
        return redirect('avisos');                              //Redireciona para pÃ¡gina inicial de avisos
    }

    /**MÃ©todo que exclui aviso
     * @param $id int identificador do aviso a ser excluÃ­do
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir($id)
    {
        Aviso::find($id)->delete();                             //Busca aviso pelo id e exclui
        return redirect()->route('avisos');                     //Redireciona para pÃ¡gina inicial de avisos
    }

    /**
     *MÃ©todo que remove avisos antigos (mais de sete dias)
     */
    private function removerAntigos()
    {
        $avisos = Aviso::antigos()->lists('id');                //Busca avisos antigos e pega id
        Aviso::destroy($avisos->all());                         //Apaga avisos antigos
    }

    public function sendNotificationToDevice(){
        $tokens =\adsproject\User::all()->lists('gcm_token');

        $deviceCollection = PushNotification::DeviceCollection();

        foreach ($tokens as $indice => $token):
            if($token != null){
                $deviceCollection->add(PushNotification::Device($token));
            }
        endforeach;

        PushNotification::app('ads')
            ->to($deviceCollection)
            ->send('Robson Wilder');
        return 'ok';
    }
}