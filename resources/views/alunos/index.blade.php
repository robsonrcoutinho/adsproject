@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  teal escurecer-4">
            <span class=" grey-text text-lighten-5">Alunos</span>
        </div>
        <table class="highlight  responsive-table">

            <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nome</th>
                <th>email</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alunos as $aluno)

                <tr>
                    <td>{{$aluno->matricula}}</td>
                    <td>{{$aluno->nome}}</td>

                    <td>
                    @if($aluno->email !=null && $aluno->email != '' )
                        {{ $aluno->email }}
                    @endif
                    <td>
                        @can('alterar', $aluno)
                        <a href="{{ route('alunos.editar', ['id'=>$aluno->id]) }}" class="btn-sm btn-success">Editar</a>
                        @endcan
                        @can('excluir', $aluno)
                        <a href="{{ route('alunos.excluir', ['id'=>$aluno->id]) }}"
                           class="btn-sm btn-danger">Excluir</a>
                        @endcan
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', new \adsproject\Aluno)
        <a href="{{ route('alunos.novo')}}" class="btn btn-default">Novo Aluno</a>
        @endcan
    </div>
@endsection