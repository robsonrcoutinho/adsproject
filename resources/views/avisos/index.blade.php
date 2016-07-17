@extends('main')
@section('conteudo')
    <div class="category">
        <div class="card-panel  #388e3c green darken-2 center">
            <span class=" grey-text text-lighten-5">Avisos</span>
        </div>
        <table class="highlight  responsive-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @forelse($avisos as $aviso)
                <tr>
                    <td>{{$aviso->id}}</td>
                    <td>{{$aviso->titulo}}</td>
                    <td>
                        @can('alterar', $aviso)
                        <a href="{{ route('avisos.editar', ['id'=>$aviso->id]) }}" class="btn disabled">Editar</a>
                        @endcan
                        @can('exclur', $aviso)
                        <a href="{{ route('avisos.excluir', ['id'=>$aviso->id]) }}" class="btn disabled">Excluir</a>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Sem Avisos!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <br/>
        <br/>
        @can('salvar', new Aviso())
        <a href="{{ route('avisos.novo')}}" class="btn btn-default">Novo aviso</a>
        @endcan
    </div>
@endsection
