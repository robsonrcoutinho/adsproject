<?php namespace adsproject\Http\Controllers;

use adsproject\Aluno;
use adsproject\Http\Requests\AlunoRequest;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use adsproject\Disciplina;
use Validator;


class AlunosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $alunos = Aluno::orderBy('nome')->get();
        return view('alunos.index', ['alunos' => $alunos]);
    }

    public function novo()
    {
        $disciplinas = Disciplina::orderBy('nome')->get();
        return view('alunos.novo', ['disciplinas' => $disciplinas]);
    }

    public function salvar(AlunoRequest $request)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula',
            'email' => 'unique:alunos,email']);
        $aluno = Aluno::create($request->all());
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $aluno->disciplinas()->sync($disciplinas);
        endif;
        return redirect()->route('alunos');
    }

    public function editar($id)
    {
        $disciplinas = Disciplina::orderBy('nome')->get();
        $aluno = Aluno::find($id);
        return view('alunos.editar', compact('aluno', 'disciplinas'));
    }

    public function alterar(AlunoRequest $request, $id)
    {
        $this->validate($request, ['matricula' => 'unique:alunos,matricula,' . $id,
            'email' => 'unique:alunos,email,' . $id]);
        $aluno = Aluno::find($id);
        $disciplinas = $request->get('disciplinas');
        if ($disciplinas != null):
            $aluno->disciplinas()->sync($disciplinas);
        elseif ($aluno->disciplinas != null && !$aluno->disciplinas->isEmpty()):
            $aluno->disciplinas()->detach($aluno->disciplinas);
        endif;
        $aluno->update($request->all());
        return redirect()->route('alunos');
    }

    public function excluir($id)
    {
        Aluno::find($id)->delete();
        return redirect()->route('alunos');
    }

    public function buscarTodos()
    {
        return Aluno::all();
    }

    public function buscarPorId($id)
    {
        return Aluno::find($id);
    }

    public function arquivo()
    {
        return view('alunos.arquivo');
    }

    public function carregar(Filesystem $filesystem, Request $request)
    {
        $this->validate($request, ['arquivo' => 'required'], ['required' => 'O :attribute precisa ser passado.']);
        $arquivo = $request->file('arquivo');
        if ($arquivo != null):
            $nomeArquivo = $arquivo->getClientOriginalName();
            $diretorio = storage_path() . '/app';
            $arquivo->move($diretorio, $nomeArquivo);
            if ($filesystem->exists($nomeArquivo)):
                $texto = utf8_encode($filesystem->get($nomeArquivo));
                //$texto = json_decode(utf8_encode($filesystem->get($nomeArquivo)), true);

                /* try {
                     $xml = simplexml_load_string($texto);
                     $this->montarLista($xml);
                     //dd($xml);
                 } catch (\Exception $e) {
                     $errors = 'Formato de arquivo incorreto.';
                     unlink($diretorio . '/' . $nomeArquivo);
                     return redirect()->route('alunos.arquivo')->withErrors($errors);
                 }*/
                unlink($diretorio . '/' . $nomeArquivo);
                $this->montarLista($texto);
//$this->montarLista($xml);
            endif;
        endif;
        return redirect()->route('alunos');
    }

    private function montarLista($texto)
    {
        if ($texto == null):
            return;
        endif;
        $linhas = explode("\n", $texto);
        foreach ($linhas as $linha):
            $dados = explode("|", $linha);

            //foreach ($texto as $dados):
            //dd($dados['matricula']);
            //foreach ($texto as $dados):
            //$dado=get_object_vars($dados);
            if (count($dados) >= 3):
                if ($this->validar($dados[0], $dados[1], $dados[2])):
                    //if ($this->validar($dados['matricula'], $dados['nome'], $dados['email'])):
                    //if ($this->validar($dados->matricula, $dados->nome, $dados->email)):
                    $this->gravar($dados);
                endif;
            endif;
        endforeach;
    }

    private function validar($matricula, $nome, $email)
    {
        $valores = ['matricula' => trim($matricula),
            'nome' => trim($nome),
            'email' => trim($email)];
        $regras = ['matricula' => 'required|min:6',
            'nome' => 'required|min:5',
            'email' => 'email'];
        $validador = Validator::make($valores, $regras);
        return !$validador->fails();
    }

    private function gravar($dados)
    {
        //$aluno = Aluno::query()->where('matricula', $dados[0])->first();
        //$aluno = Aluno::query()->where('matricula', $dados['matricula'])->first();
        $aluno = Aluno::withTrashed()->where('matricula', $dados[0])->first();
        if ($aluno == null):
            $aluno = new Aluno();
        endif;
        $aluno->matricula = trim($dados[0]);
        $aluno->nome = trim($dados[1]);
        $aluno->email = trim($dados[2]);
        /*$aluno->matricula = trim($dados['matricula']);
        $aluno->nome = trim($dados['nome']);
        $aluno->email = trim($dados['email']);*/
        /*$aluno->matricula = trim($dados->matricula);
        $aluno->nome = trim($dados->nome);
        $aluno->email = trim($dados->email);*/
        $aluno->deleted_at = null;
        $disciplinas=array();
        if(count($dados)>3):
            for($i=3; $i<count($dados);$i++):
                //dd($dados);
                $disciplina =Disciplina::query()->where('codigo', trim($dados[$i]))->lists('id')->first();
                $disciplinas[]=$disciplina;
            //dd($disciplinas);
                endfor;
            //dd($disciplinas);
            endif;
             $aluno->save();
        $aluno->disciplinas()->sync($disciplinas);
    }
}